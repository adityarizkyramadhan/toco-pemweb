<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //'name',
        //'image',
        //'description',
        //'price',
        for ($i = 1; $i <= 10; $i++) {
            Product::factory()->create([
                'name' => 'Test Product ' . $i,
                'image' => 'https://picsum.photos/200/300',
                'description' => 'Test Product Description ' . $i,
                'price' => 100,
            ]);
        }
    }
}
