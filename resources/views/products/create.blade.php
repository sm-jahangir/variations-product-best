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

            <!-- Variation Options and Values -->
            @foreach($variationOptions as $option)
                <div class="mb-3">
                    <label for="{{ $option->name }}" class="form-label">{{ $option->name }}:</label>
                    <select class="form-select variation-select" name="variations[{{ $option->id }}][]" multiple required>
                        <option value="" disabled>Select {{ $option->name }}</option>
                        @foreach($option->values as $value)
                            <option value="{{ $value->id }}" data-price-label="{{ $value->value }}"> {{ $value->value }} </option>
                        @endforeach
                    </select>
                    <div class="mt-2 price-fields" style="display: none;">
                        <label for="prices" class="form-label">Prices for {{ $option->name }}:</label>
                        <div class="prices-container"></div>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Create Product</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Product List</a>
    </div>

@endsection
@push('js')
    
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add change event listener to each variation select
        var variationSelects = document.querySelectorAll('.variation-select');
        variationSelects.forEach(function (select) {
            select.addEventListener('change', function () {
                updatePriceFields(this);
            });
        });

        // Function to update the display of price fields based on selected values
        function updatePriceFields(select) {
            var selectedOptions = select.selectedOptions;
            var priceFieldsContainer = select.closest('.mb-3').querySelector('.price-fields');
            var pricesContainer = priceFieldsContainer.querySelector('.prices-container');

            // Reset and hide existing price fields
            pricesContainer.innerHTML = '';
            priceFieldsContainer.style.display = 'none';

            // Display price fields only if at least one option is selected
            if (selectedOptions.length > 0) {
                priceFieldsContainer.style.display = 'block';

                // Extract variation ID from select's name
                var variationId = select.name.match(/\[(\d+)\]/)[1];

                // Create and append price input fields for selected options
                Array.from(selectedOptions).forEach(function (option) {
                    var priceLabel = option.getAttribute('data-price-label');
                    pricesContainer.innerHTML += `
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="prices_${variationId}_${option.value}">${priceLabel}</label>
                            <input type="text" class="form-control" name="prices[${variationId}][${option.value}]" required>
                        </div>
                    `;
                });
            }
        }
    });
</script>


@endpush