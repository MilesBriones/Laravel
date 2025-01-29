<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\movies;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller{
    public function index(Request $request)
{
    $search = $request->input('search');

    if ($search) {
        $movie = movies::where('title', 'like', '%' . $search . '%')
            ->orWhere('genre', 'like', '%' . $search . '%')
            ->get()
            ->groupBy('genre');
    } else {
        $movie = movies::all()->groupBy('genre');
    }

    return view('home.index', compact('movie'));
}
}
