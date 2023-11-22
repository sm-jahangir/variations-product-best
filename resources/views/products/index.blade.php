<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Product List</h2>

        @foreach($products as $product)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach

        <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">Add New Product</a>
    </div>
@endsection
