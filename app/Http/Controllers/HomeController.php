<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();
        $products = Product::with(['gender', 'platform'])->take(4)->get();
        return view('home', compact('platforms', 'products'));
    }
}
