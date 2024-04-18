<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'name' => 'First Admin',
            'role' => true,
            'email' => 'admin123@admin.com',
            'password' => Hash::make('Password123!'),
            'phone_number' => fake()->phoneNumber(),
            'date_of_birth' => fake()->dateTime(),
            'gender' => 'male',
            'id_card_number' => '123OKEY123',
        ]);
    }
}
