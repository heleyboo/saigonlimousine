<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate all tables for clean seeding
        $this->truncateTables();

        // Run CMS seeder
        $this->call([
            CmsSeeder::class,
            VietnamDataSeeder::class,
        ]);

        // Seed 12 fake testimonials
        \App\Models\Post::factory()->count(12)->create(['type' => 'review']);
    }

    private function truncateTables(): void
    {
        // Disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all tables
        $tables = [
            'posts',
            'categories',
            'services',
            'tags',
            'taggables',
            'navigation_menus',
            'navigation_items',
            'media',
            'related_posts',
            'jobs',
            'failed_jobs',
            'cache',
            'cache_locks',
            'sessions',
            'password_reset_tokens',
        ];

        foreach ($tables as $table) {
            if (\Schema::hasTable($table)) {
                \DB::table($table)->truncate();
            }
        }

        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
