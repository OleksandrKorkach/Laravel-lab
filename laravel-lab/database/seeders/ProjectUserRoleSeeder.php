<?php

namespace Database\Seeders;

use App\Models\ProjectUserRole;
use Illuminate\Database\Seeder;

class ProjectUserRoleSeeder extends Seeder
{
    public function run(): void
    {
        ProjectUserRole::insert([
            ['id' => 1, 'name' => 'Project Manager'],
            ['id' => 2, 'name' => 'Software Developer'],
            ['id' => 3, 'name' => 'Technical Architect'],
            ['id' => 4, 'name' => 'QA Tester'],
            ['id' => 5, 'name' => 'UI Designer'],
            ['id' => 6, 'name' => 'UX Designer'],
            ['id' => 7, 'name' => 'UI/UX Designer'],
            ['id' => 8, 'name' => 'Business Analyst'],
            ['id' => 9, 'name' => 'DevOps Engineer'],
            ['id' => 10, 'name' => 'Systems Analyst'],
            ['id' => 11, 'name' => 'System Administrator'],
            ['id' => 12, 'name' => 'Network Engineer'],
            ['id' => 13, 'name' => 'Database Administrator'],
            ['id' => 14, 'name' => 'Mobile Developer'],
            ['id' => 15, 'name' => 'Web Developer'],
            ['id' => 16, 'name' => 'Information Security Specialist'],
            ['id' => 17, 'name' => 'Data Analyst'],
            ['id' => 18, 'name' => 'Machine Learning Engineer'],
            ['id' => 19, 'name' => 'Undefined'],
        ]);
    }
}
