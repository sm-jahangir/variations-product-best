<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Product Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>

                <h6 class="mt-3">Variations:</h6>
                <ul>
                    @foreach($product->variations as $variation)
                        <li>{{ $variation->name }}: {{ $variation->pivot->price }}</li>
                    @endforeach
                </ul>

                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Product List</a>
            </div>
        </div>
    </div>
@endsection
