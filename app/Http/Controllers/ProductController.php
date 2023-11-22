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

    public function show($id)
    {
        return $product = Product::with('variations')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $variationOptions = VariationOption::with('values')->get();
        return view('products.create', compact('variationOptions'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'variations' => 'required|array',
        'prices' => 'required|array',
    ]);

    try {
        // Create the product
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        // Attach variations with prices
        foreach ($request->input('variations') as $optionId => $values) {
            $prices = $request->input('prices')[$optionId];

            foreach ($values as $valueId) {
                $price = $prices[$valueId];
                $product->variations()->attach($valueId, ['price' => $price]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    } catch (\Exception $e) {
        // Log the exception or handle it appropriately
        return redirect()->route('products.index')->with('error', 'Error creating product');
    }
}

    
    

    // Add update and delete methods as needed
}
