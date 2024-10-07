<?php

namespace Database\Seeders;

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
            ],
            [
                'name' => 'الرياضيات',
                'description' => 'تعلم أساسيات الرياضيات',
            ],
            [
                'name' => 'الإحصاء والاحتمالات',
                'description' => 'تعلم أساسيات الإحصاء والاحتمالات',
            ],
            [
                'name' => 'الفيزياء',
                'description' => 'تعلم أساسيات الفيزياء',
            ],
            [
                'name' => 'الكيمياء',
                'description' => 'تعلم أساسيات الكيمياء',
            ],
            [
                'name' => 'الهندسة الكهربائية',
                'description' => 'تعلم أساسيات الهندسة الكهربائية',
            ],
            [
                'name' => 'الطب والصحة',
                'description' => 'تعلم أساسيات الطب والصحة',
            ],
            [
                'name' => 'اللغة والأدب',
                'description' => 'تعلم أساسيات اللغة والأدب',
            ],
            [
                'name' => 'التاريخ',
                'description' => 'تعلم أساسيات التاريخ',
            ],
            [
                'name' => 'الفلسفة',
                'description' => 'تعلم أساسيات الفلسفة',
            ],
            [
                'name' => 'علم النفس',
                'description' => 'تعلم أساسيات علم النفس',
            ],
            [
                'name' => 'القانون',
                'description' => 'تعلم أساسيات القانون',
            ],
            [
                'name' => 'التسويق والإعلان',
                'description' => 'تعلم أساسيات التسويق والإعلان',
            ],
            [
                'name' => 'الاقتصاد وإدارة الأعمال',
                'description' => 'تعلم أساسيات الاقتصاد وإدارة الأعمال',
            ],
        ];
        foreach ($courseCategories as $courseCategory) {
            \App\Models\Category::create($courseCategory);
        }
    }
}
