<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanoramaPhoto;

class HomeController extends Controller
{
    public function showHomePage()
    {
        return view('home', [
            'images' => PanoramaPhoto::all()
        ]);
    }
}
