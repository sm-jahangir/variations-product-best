<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\VariationOption;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $variationOptions = VariationOption::with('values')->get();
        return view('products.create', compact('variationOptions'));
    }

    public function store(Request $request)
    {
        $product = Product::create($request->except('variations'));

        if ($request->has('variations')) {
            $product->variations()->attach($request->input('variations'));
        }

        return redirect()->route('products.index');
    }

    // Add update and delete methods as needed
}
