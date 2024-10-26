<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'course_id' => 1,
                'title' => 'Introduction to Html',
                'content' => 'Html Introduction',
            ],
            [
                'course_id' => 1,
                'title' => 'introduction to CSS',
                'content' => 'Css Introduction',
            ],
            [
                'course_id' => 1,
                'title' => 'introduction to JavaScript',
                'content' => 'JavaScript Introduction',
            ],
            [
                'course_id' => 1,
                'title' => 'introduction to Laravel 11',
                'content' => 'Laravel 11 Introduction',
            ],
            [
                'course_id' => 2,
                'title' => 'basic Flutter 3: The Flutter Framework',
                'content' => 'Flutter 3: The Flutter Framework',
            ],
        ];

        foreach ($lessons as $lesson) {
            \App\Models\Lesson::create($lesson);
        }
    }
}
