<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    use HasFactory;
    public function variations()
    {
        return $this->belongsToMany(VariationValue::class, 'product_variation_value')->withPivot('price');
    }
    // Group variations by option_id
    public function groupedByOption()
    {
        $variationsByOption = $this->variations()
            ->with('option') // Eager load the option relationship
            ->get()
            ->groupBy('option_id')
            ->map(function ($values, $optionId) {
                $option = VariationOption::find($optionId);

                return [
                    'option_id' => $optionId,
                    'option' => $option, // Include the option details
                    'values' => $values->map(function ($value) {
                        return [
                            'value_id' => $value->id,
                            'value_name' => $value->value,
                            'price' => $value->pivot->price,
                        ];
                    }),
                ];
            });

        return $variationsByOption->values(); // Re-index the array
    }
}
