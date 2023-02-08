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
        \App\Models\User::factory(0)->create();
        \App\Models\User::factory()->create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => '$2y$10$mLDDnz6BbU07qmiGT09hl.6ws/uyh0bF9DNVcWcJMcwKjYWPnkKWS',
        ]);
    }
}
