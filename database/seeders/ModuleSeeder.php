<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first manager or create a default one
        $manager = User::where('role', 'manager')->first();
        
        if (!$manager) {
            $manager = User::create([
                'name' => 'Default Manager',
                'email' => 'default@example.com',
                'password' => bcrypt('password'),
                'role' => 'manager',
            ]);
        }

        Module::updateOrCreate(
            ['code' => 'CS101', 'manager_id' => $manager->id],
            ['name' => 'Introduction to Computer Science', 'description' => 'Basics of programming and computer fundamentals']
        );

        Module::updateOrCreate(
            ['code' => 'MATH101', 'manager_id' => $manager->id],
            ['name' => 'Algebra I', 'description' => 'Fundamentals of algebraic equations and problem solving']
        );

        Module::updateOrCreate(
            ['code' => 'ENG101', 'manager_id' => $manager->id],
            ['name' => 'English Composition', 'description' => 'Writing and communication skills']
        );

        Module::updateOrCreate(
            ['code' => 'PHYS101', 'manager_id' => $manager->id],
            ['name' => 'Physics I', 'description' => 'Mechanics and motion']
        );

        Module::updateOrCreate(
            ['code' => 'CHEM101', 'manager_id' => $manager->id],
            ['name' => 'Chemistry I', 'description' => 'General chemistry principles']
        );
    }
}
