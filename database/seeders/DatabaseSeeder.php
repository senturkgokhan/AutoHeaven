<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            BrandSeeder::class,
            ModelSeeder::class,
            UserSeeder::class,
            CarDamageSeeder::class,
            CarSeeder::class,
            BlogSeeder::class,
            ContactSeeder::class
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'surname' => 'Example',
            'phone' => '0000000000',
            'email' => 'test@example.com',
        ]);
    }
}
