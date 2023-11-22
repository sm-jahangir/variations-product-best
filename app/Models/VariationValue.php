<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationValue extends Model
{
    use HasFactory;
    protected $fillable = ['option_id', 'value'];

    public function option()
    {
        return $this->belongsTo(VariationOption::class, 'option_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_variation_value', 'variation_value_id', 'product_id')
            ->withPivot('price');
    }
}
