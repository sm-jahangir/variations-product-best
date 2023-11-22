<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\VariationValue;
use App\Models\VariationOption;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VariationValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Color values
      $colorOption = VariationOption::where('name', 'Color')->first();
      $colorValues = ['Red', 'Yellow', 'Green'];

      foreach ($colorValues as $value) {
          $variationValue = VariationValue::create([
              'option_id' => $colorOption->id,
              'value' => $value,
          ]);

          // Assign values to the pivot table
          $this->assignToProduct($variationValue, 1, 19.99); // Assuming product_id 1 and price 19.99
      }

      // Size values
      $sizeOption = VariationOption::where('name', 'Size')->first();
      $sizeValues = ['L', 'XL', 'XXL'];

      foreach ($sizeValues as $value) {
          $variationValue = VariationValue::create([
              'option_id' => $sizeOption->id,
              'value' => $value,
          ]);

          // Assign values to the pivot table
          $this->assignToProduct($variationValue, 1, 24.99); // Assuming product_id 1 and price 24.99
      }
  }

  private function assignToProduct(VariationValue $variationValue, $productId, $price)
  {
      $product = Product::find($productId);

      if ($product) {
          $product->variations()->attach($variationValue->id, ['price' => $price]);
      }
  }
}