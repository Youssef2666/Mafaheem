<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'The Complete 2022 Web Development Bootcamp',
                'description' => 'The Complete 2022 Web Development Bootcamp',
                'instructor_id' => 1,
                'level' => 'beginner',
                'price' => 300,
                'duration' => 120,
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                'subscription_plan_id' => 1
            ],
            [
                'title' => 'The Complete 2022 Mobile App Development Bootcamp',
                'description' => 'The Complete 2022 Mobile App Development Bootcamp',
                'instructor_id' => 1,
                'level' => 'beginner',
                'price' => 250,
                'duration' => 180,
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                'subscription_plan_id' => 1
            ],
            [
                'title' => 'The Complete 2024 Unit Testing',
                'description' => 'The Complete 2024 Unit Testing',
                'instructor_id' => 3,
                'level' => 'advanced',
                'price' => 110,
                'duration' => 60,
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                'subscription_plan_id' => 2
            ]
            ];
        foreach ($courses as $course) {
            \App\Models\Course::create($course);
        }
    }
}
