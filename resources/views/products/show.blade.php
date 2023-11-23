<!-- resources/views/products/show.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <div class="product-container">
            <div class="product-image">
                <img src="{{ asset('path/to/product-image.jpg') }}" alt="Product Image" class="img-fluid">
            </div>
            <div class="product-details">
                <div class="product-title">{{ $product->name }}</div>
                <div class="product-description">
                    {{ $product->description }}
                </div>
                <div class="product-price">${{ $product->price }}</div>
                <div class="add-to-cart">
                    <input type="number" class="quantity-input form-control" value="1" min="1">
                    <button class="btn btn-primary">Add to Cart</button>
                </div>
                <div class="product-actions">
                    <!-- Additional product actions (e.g., wishlist, share) can be added here -->
                    <button class="btn btn-outline-secondary">Add to Wishlist</button>
                    <button class="btn btn-outline-secondary">Share</button>
                </div>
            </div>
        </div>

        <!-- Display grouped variations -->
        <div class="grouped-variations">
            <h2>Variations</h2>
            @foreach($groupedVariations as $group)
                <h3>{{ $group['option']->name }}</h3>
                <ul>
                    @foreach($group['values'] as $value)
                        <li>
                            {{ $value['value_name'] }} - ${{ $value['price'] }}
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
@endsection
