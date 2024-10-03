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
                'title' => 'Introduction to Laravel 9: The Laravel Framework',
                'content' => 'Laravel 9: The Laravel Framework',
            ],
            [
                'course_id' => 1,
                'title' => 'basic Laravel 10: The Laravel Framework',
                'content' => 'Laravel 10: The Laravel Framework',
            ],
            [
                'course_id' => 2,
                'title' => 'basic Flutter 3: The Flutter Framework',
                'content' => 'Flutter 3: The Flutter Framework',
            ],
        ];
    }
}
