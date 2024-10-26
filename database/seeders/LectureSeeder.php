<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lectures = [
            [
                'lesson_id' => 1,
                'title' => 'Tags in Html',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Html attributes',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Html advanced',
            ],
            [
                'lesson_id' => 2,
                'title' => 'CSS selectors',
            ],
            [
                'lesson_id' => 2,
                'title' => 'CSS media queries',
            ],
            [
                'lesson_id' => 2,
                'title' => 'CSS display properties',
            ],
            [
                'lesson_id' => 2,
                'title' => 'CSS advanced',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Syntax',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript variables',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Strings',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Operators',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Functions',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Objects',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Arrays',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript Events',
            ],
            [
                'lesson_id' => 3,
                'title' => 'JavaScript DOM',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Install Xampp',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Setup Laravel',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Create First Project',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Create First Controller',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Create First Model',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Create First View',
            ],
            [
                'lesson_id' => 4,
                'title' => 'Create First Route',
            ],
        ];

        foreach ($lectures as $lecture) {
            \App\Models\Lecture::create($lecture);
        }
    }
}
