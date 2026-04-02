<?php

namespace Database\Seeders;

use App\Models\Article; // Make sure to import your model
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generate 30 fake articles
        Article::factory(30)->create();
    }
}
