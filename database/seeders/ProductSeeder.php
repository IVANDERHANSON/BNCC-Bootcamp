<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory()->create([
            'categoryId' => 1,
            'name' => 'Harry Potter 1',
            'price' => '100000',
            'stock' => '0',
            'photo' => 'Book1.jpg'
        ]);

        \App\Models\Product::factory()->create([
            'categoryId' => 1,
            'name' => 'Harry Potter 2',
            'price' => '100000',
            'stock' => '200',
            'photo' => 'Book2.jpg'
        ]);

        \App\Models\Product::factory()->create([
            'categoryId' => 1,
            'name' => 'Harry Potter 3',
            'price' => '100000',
            'stock' => '200',
            'photo' => 'Book3.jpg'
        ]);

        \App\Models\Product::factory()->create([
            'categoryId' => 2,
            'name' => 'Pizza',
            'price' => '50000',
            'stock' => '50',
            'photo' => 'Pizza.jpg'
        ]);

        \App\Models\Product::factory()->create([
            'categoryId' => 2,
            'name' => 'Hamburger',
            'price' => '50000',
            'stock' => '50',
            'photo' => 'Hamburger.jpg'
        ]);

        \App\Models\Product::factory()->create([
            'categoryId' => 2,
            'name' => 'Fried Rice',
            'price' => '50000',
            'stock' => '50',
            'photo' => 'Fried Rice.jpg'
        ]);
    }
}
