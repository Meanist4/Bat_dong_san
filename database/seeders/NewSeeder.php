<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin User',
                    'username' => 'admin_user',
                    'email' => 'admin.@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'admin',
                    'status' => 1,
                    'profile_picture' => null,
                    'phone_number' => 1234567890,
                ],
                [
                    'name' => 'Regular User',
                    'username' => 'reg_user',
                    'email' => 'reg_user.@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'user',
                    'status' => 1,
                    'profile_picture' => null,
                    'phone_number' => 9876543210,
                ],
                [
                    'name' => ' User 2',
                    'username' => 'blocked_user',
                    'email' => 'blocked_user.@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'user',
                    'status' => 1,
                    'profile_picture' => null,
                    'phone_number' => 1122334455,
                ]
            ]
        );
        DB::table('news')->insert(
            [
                [
                    'author_id' => 1,
                    'title' => 'Welcome to Our News Portal',
                    'description' => 'This is the first news article on our portal. Stay tuned for more updates!',
                    'published_at' => now(),
                    'status' => true,
                ],
                [
                    'author_id' => 1,
                    'title' => 'User Posted News',
                    'description' => 'This news article is posted by a regular user.',
                    'published_at' => now(),
                    'status' => true,
                ]
            ]
        );
        DB::table('sale_posts')->insert(
            [
                [
                    'user_id' => 2,
                    'title' => 'Spacious 3 Bedroom Apartment for Sale',
                    'description' => 'A beautiful and spacious 3 bedroom apartment located in the heart of the city.',
                    'price' => 250000.00,
                    'area' => 1500.50,
                    'address' => '123 Main St, Cityville',
                    'bedrooms' => 3,
                    'bathrooms' => 2,
                    'is_furnished' => true,
                    'status' => true,
                ],
                [
                    'user_id' => 3,
                    'title' => 'Cozy 2 Bedroom House for Sale',
                    'description' => 'A cozy and charming 2 bedroom house in a quiet neighborhood.',
                    'price' => 180000.00,
                    'area' => 1200.00,
                    'address' => '456 Oak St, Townsville',
                    'bedrooms' => 2,
                    'bathrooms' => 1,
                    'is_furnished' => false,
                    'status' => true,
                ]
            ]
        );
        //
    }
}
