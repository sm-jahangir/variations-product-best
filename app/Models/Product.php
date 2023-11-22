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
}
