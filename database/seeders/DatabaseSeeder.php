<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@bhagva.org'],
            [
                'name'              => 'Admin',
                'email'             => 'admin@bhagva.org',
                'password'          => Hash::make('Admin@123'),
                'is_admin'          => 1,
                'email_verified_at' => now(),
            ]
        );
    }
}
