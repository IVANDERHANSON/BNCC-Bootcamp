<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Cart::factory()->create([
            'userId' => 2,
            'productId' => 1,
            'category' => 'Book',
            'productName' => 'Harry Potter 1',
            'productPrice' => '100000',
            'productPhoto' => 'Book1.jpg',
            'quantity' => 20
        ]);

        \App\Models\Cart::factory()->create([
            'userId' => 2,
            'productId' => 4,
            'category' => 'Food',
            'productName' => 'Pizza',
            'productPrice' => '500000',
            'productPhoto' => 'Pizza.jpg',
            'quantity' => 10
        ]);

        \App\Models\Cart::factory()->create([
            'userId' => 2,
            'productId' => 3,
            'category' => 'Book',
            'productName' => 'Harry Potter 3',
            'productPrice' => '100000',
            'productPhoto' => 'Book3.jpg',
            'quantity' => 5
        ]);
    }
}
