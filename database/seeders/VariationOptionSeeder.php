<?php

namespace Database\Seeders;

use App\Models\VariationOption;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VariationOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VariationOption::create(['name' => 'Color']);
        VariationOption::create(['name' => 'Size']);
    }
}
