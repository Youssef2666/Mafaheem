<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseCategories = [
            [
                'name' => 'Web Development',
                'description' => 'Learn the basics of web development',
            ],
            [
                'name' => 'Data Science',
                'description' => 'Learn the basics of data science',
            ],
            [
                'name' => 'Artificial Intelligence',
                'description' => 'Learn the basics of artificial intelligence',
            ],
            [
                'name' => 'Machine Learning',
                'description' => 'Learn the basics of machine learning',
            ],
            [
                'name' => 'Cyber Security',
                'description' => 'Learn the basics of cyber security',
            ],
            [
                'name' => 'Software Development',
                'description' => 'Learn the basics of software development',
            ],
            [
                'name' => 'Game Development',
                'description' => 'Learn the basics of game development',
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'Learn the basics of mobile development',
            ],
            [
                'name' => 'Software Testing',
                'description' => 'Learn the basics of software testing',
            ]
            ];
        foreach ($courseCategories as $courseCategory) {
            \App\Models\Category::create($courseCategory);
        }
    }
}
