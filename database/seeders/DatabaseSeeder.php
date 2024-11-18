<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AppsSeeder::class,
            LightAppCategoriesSeeder::class,
            LightAppsSeeder::class,
            ContextTypesTableSeeder::class,
            ContextOptionsTableSeeder::class,
            QuotesSeeder::class,
            WallpaperSeeder::class,
            UserTypeSeeder::class
        ]);
    }
}
