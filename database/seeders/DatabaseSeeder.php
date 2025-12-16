<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update a manager and a student for testing (idempotent)
        $manager = User::updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager One',
                'password' => bcrypt('secret'),
                'role' => 'manager',
            ]
        );

        User::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Student One',
                'password' => bcrypt('student123'),
                'role' => 'student',
                'manager_id' => $manager->id,
            ]
        );

        // Seed modules
        // $this->call(ModuleSeeder::class);
    }
}
