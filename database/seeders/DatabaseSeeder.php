<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'handphone' => '081344445555',
            'isAdmin' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'handphone' => '081366667777',
            'isAdmin' => 0
        ]);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
