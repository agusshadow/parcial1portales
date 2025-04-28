<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with(['gender', 'platform'])->get();

        return view('products.index', compact('products'));
    }

    public function view(int $id) {
        $product = Product::with(['gender', 'platform'])->find($id);

        return view('products.view', compact('product'));
    }
}
