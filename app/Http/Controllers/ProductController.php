<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['gender', 'platform'])->get();
        return view('products.index', compact('products'));
    }

    public function show(int $id)
    {
        $product = Product::with(['gender', 'platform'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

}
