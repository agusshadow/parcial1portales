<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;

class HomeController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();
        return view('home', compact('platforms'));
    }
}
