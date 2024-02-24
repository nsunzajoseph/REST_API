<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'name' => 'water kilimanjaro',
            'description' => 'Modi iste animi sapiente aut. Nihil maiores odio tenetur est eos voluptatem non. Quo quasi pariatur quis earum iste.'
        ];

        Product::create($products);
    }
}
