<?php

namespace Database\Seeders;
use App\Models\User;
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
        User::factory()->times(1)->create([
            "name" => "David Alvarez C",
            "rol" => "Admin",
            "email" => "daalvarez17@utpl.edu.ec",
            "password" => bcrypt("password")
        ]);
    }
}
