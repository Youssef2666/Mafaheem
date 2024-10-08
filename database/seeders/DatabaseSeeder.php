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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User4',
            'email' => 'test4@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test User3',
            'email' => 'test3@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test User5',
            'email' => 'test5@example.com',
        ]);

        $this->call([
            CourseCategorySeeder::class,
            SubscriptionPlanSeeder::class,
            CourseSeeder::class,
            WorkshopSeeder::class,
            LessonSeeder::class,
            LectureSeeder::class,
            CategoryCourseSeeder::class,
            RoadMapSeeder::class,
            CourseRoadmapSeeder::class
        ]);
    }
}
