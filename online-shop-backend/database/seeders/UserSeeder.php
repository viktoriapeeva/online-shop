<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'email'=> 'test@example.com',
                'name'=> 'Test User',
                'password'=> bcrypt('password'),
                'phone'=> '1234567890',
                'address'=> '123 Test St, Test City, Test State, 12345',
                'email_verified_at'=> now(),
            
            ],
        );
        User::factory()->count(2)->create();

       
    }
}
