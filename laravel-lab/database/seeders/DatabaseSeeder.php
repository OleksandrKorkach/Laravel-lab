<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProjectUserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            StatusSeeder::class,
            ProjectUserRoleSeeder::class,
            ProjectUserSeeder::class,
            ProjectStatusSeeder::class,
            TaskSeeder::class,
            TaskUserSeeder::class,
        ]);
    }
}
