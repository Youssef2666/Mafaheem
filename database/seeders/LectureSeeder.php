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
                'title' => 'Install Xampp',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Setup Laravel',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Create First Project',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Create First Controller',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Create First Model',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Create First View',
            ],
            [
                'lesson_id' => 1,
                'title' => 'Create First Route',
            ],
        ];
    }
}
