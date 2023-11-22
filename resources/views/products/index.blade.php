<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Product List</h2>

        <ul class="list-group">
            @foreach($products as $product)
                <li class="list-group-item">{{ $product->name }} - ${{ $product->price }}</li>
            @endforeach
        </ul>

        <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">Add New Product</a>
    </div>
@endsection
