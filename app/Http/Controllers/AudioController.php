<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function show($id)
    {
        $audioFile = Audio::with('category')->findOrFail($id);
        $audioFile->incrementPlays();
        $similarAudios = Audio::where('category_id', $audioFile->category_id)
            ->where('id', '!=', $audioFile->id)
            ->take(5)
            ->get();
        return view('audio.show', compact('audioFile', 'similarAudios'));
    }
}
