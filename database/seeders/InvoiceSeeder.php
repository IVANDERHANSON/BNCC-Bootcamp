<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Invoice::factory()->create([
            'userId' => 2,
            'category' => 'Book',
            'productName' => 'Harry Potter 1',
            'productPrice' => '100000',
            'productPhoto' => 'Book1.jpg',
            'quantity' => 1,
            'address' => 'Jalan Anggrek',
            'postalCode' => '12345',
            'totalPrice' => '100000'
        ]);

        \App\Models\Invoice::factory()->create([
            'userId' => 2,
            'category' => 'Food',
            'productName' => 'Pizza',
            'productPrice' => '500000',
            'productPhoto' => 'Pizza.jpg',
            'quantity' => 1,
            'address' => 'Jalan Anggrek',
            'postalCode' => '12345',
            'totalPrice' => '50000'
        ]);
    }
}
