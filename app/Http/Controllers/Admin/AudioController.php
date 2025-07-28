<?php

namespace App\Http\Controllers\Admin;

use App\Models\Audio;
use App\Models\Category;
use getID3;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $audioFiles = Audio::with('category')->latest()->paginate(5);
        return view('admin.audio.index', compact('audioFiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.audio.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'audio_file' => 'required|file|mimes:mp3,wav,ogg|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $audio = new Audio();
        $audio->title = $request->title;
        $audio->duration = $request->duration;
        $audio->description = $request->description;
        $audio->category_id = $request->category_id;

        if ($request->hasFile('audio_file')) {
            $audio->file_path = $request->file('audio_file')->store('audio_files', 'public');
            $durationAnalyzer = new getID3();
            $fileInfo = $durationAnalyzer->analyze(storage_path('app/public/' . $audio->file_path));
            $audio->duration = $fileInfo['playtime_seconds'] ?? 0;
        }

        if ($request->hasFile('cover_image')) {
            $audio->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        }

        $audio->save();

        return redirect()->route('audios.index')->with('success', 'Audio file created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $audio = Audio::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.audio.edit', compact('audio', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $audio = Audio::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $audio->title = $request->title;
        $audio->description = $request->description;
        $audio->category_id = $request->category_id;

        if ($request->hasFile('audio_file')) {
            if ($audio->file_path) {
                Storage::disk('public')->delete($audio->file_path);
            }

            $audio->file_path = $request->file('audio_file')->store('audio_files', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($audio->cover_image) {
                Storage::disk('public')->delete($audio->cover_image);
            }

            $audio->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        }

        $audio->save();

        return redirect()->route('audios.index')->with('success', 'Audio file updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audio $audio)
    {
        if ($audio->file_path) {
            Storage::disk('public')->delete($audio->file_path);
        }
        if ($audio->cover_image) {
            Storage::disk('public')->delete($audio->cover_image);
        }
        $audio->delete();

        return redirect()->route('audios.index')->with('success','Audio file deleted successfully.');
    }
}
