<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Matías',
            'email' => 'matias@correo.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory(10)->create();

        \App\Models\Invoice::factory(100)->create();

    }
}
