<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "name" => "superadmin",
            "email" => "superadmin@gmail.com",
            "password" => bcrypt("Superadmin123@"),
            "role" => "superadmin"
        ]);
    }
}
