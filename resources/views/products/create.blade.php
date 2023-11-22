<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Create New Product</h2>

        <form method="post" action="{{ route('products.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Product Description:</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Product Price:</label>
                <input type="text" class="form-control" name="price" required>
            </div>

            <button type="submit" class="btn btn-success">Create Product</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Product List</a>
    </div>
@endsection
