<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Gender;
use App\Models\Platform;

class ProductController extends Controller
{
    public function index()
    {
        $filters = request()->only(['gender', 'platform']);

        $query = Product::with(['gender', 'platform']);

        $filterMap = [
            'gender' => 'gender_id',
            'platform' => 'platform_id',
        ];

        foreach ($filters as $key => $value) {
            if (!empty($value) && isset($filterMap[$key])) {
                $query->where($filterMap[$key], $value);
            }
        }

        $products = $query->get();

        $genders = Gender::all();
        $platforms = Platform::all();

        return view('products.index', compact('products', 'genders', 'platforms'));
    }


    public function show(int $id)
    {
        $product = Product::with(['gender', 'platform'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

}
