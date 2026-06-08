<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin FURE',
            'email' => 'admin@fure.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            LocationSeeder::class,
            FurnitureSeeder::class,
            StockTransactionSeeder::class,
        ]);
    }
}
