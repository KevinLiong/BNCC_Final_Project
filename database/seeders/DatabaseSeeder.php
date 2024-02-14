<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'phoneNumber' => '081213141516',
            'isAdmin' => true,
        ]);

        User::create([
            'name' => 'Louis Stray',
            'email' => 'louis.stray@gmail.com',
            'password' => Hash::make('12345678'),
            'phoneNumber' => '081388776655',
        ]);

        User::create([
            'name' => 'Peter Crow',
            'email' => 'peter.crow@gmail.com',
            'password' => Hash::make('87654321'),
            'phoneNumber' => '081211223344',
        ]);

        Category::create([
            'name' => 'Clothes'
        ]);

        Category::create([
            'name' => 'Electronics'
        ]);

        Category::create([
            'name' => 'Foods'
        ]);

        Category::create([
            'name' => 'Books'
        ]);

        Category::create([
            'name' => 'Drinks'
        ]);

    }
}
