<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'uuid' => fake()->uuid(),
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),
            'remember_token' => Str::random(60),
        ]);

        // Assign the "admin" role to the admin user
        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole, ['created_at' => now(), 'updated_at' => now()]);

        $user = User::create([
            'name' => 'User',
            'uuid' => fake()->uuid(),
            'email' => 'user@example.com',
            'password' => bcrypt('userpassword'),
            'remember_token' => Str::random(60),
        ]);

        // Assign the "user" role to the regular user
        $userRole = Role::where('name', 'user')->first();
        $user->roles()->attach($userRole, ['created_at' => now(), 'updated_at' => now()]);
    }
}
