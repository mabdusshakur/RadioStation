<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Audio;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $userCount = User::count();
        $audioCount = Audio::count();
        $categoryCount = Category::count();
        $recentAudios = Audio::with('category')->latest()->take(5)->get();
        return view('admin.dashboard',[
            'userCount' => $userCount,
            'audioCount' => $audioCount,
            'categoryCount' => $categoryCount,
            'recentAudios' => $recentAudios,
        ]);
    }
}
