<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryCourseAssociations = [
            // [course_id, category_id]
            [1, 1], // Course ID 1 belongs to Category ID 1 (Web Development)
            [1, 2], // Course ID 1 belongs to Category ID 2 (Data Science)
            [2, 1], // Course ID 2 belongs to Category ID 1 (Web Development)
            [3, 3], // Course ID 3 belongs to Category ID 3 (Artificial Intelligence)
            [4, 4], // Course ID 4 belongs to Category ID 4 (Machine Learning)
            [5, 5], // Course ID 5 belongs to Category ID 5 (Cyber Security)
            [6, 6], // Course ID 6 belongs to Category ID 6 (Software Development)
            [7, 7], // Course ID 7 belongs to Category ID 7 (Game Development)
            [8, 8], // Course ID 8 belongs to Category ID 8 (Mobile Development)
            [9, 9], // Course ID 9 belongs to Category ID 9 (Software Testing)
            // Arabic Categories
            [10, 10], // Course ID 10 belongs to Category ID 10 (الرياضيات)
            [11, 11], // Course ID 11 belongs to Category ID 11 (الإحصاء والاحتمالات)
            [12, 12], // Course ID 12 belongs to Category ID 12 (الفيزياء)
            [13, 13], // Course ID 13 belongs to Category ID 13 (الكيمياء)
            [14, 14], // Course ID 14 belongs to Category ID 14 (الهندسة الكهربائية)
            [15, 15], // Course ID 15 belongs to Category ID 15 (الطب والصحة)
            [16, 16], // Course ID 16 belongs to Category ID 16 (اللغة والأدب)
            [17, 17], // Course ID 17 belongs to Category ID 17 (التاريخ)
            [18, 18], // Course ID 18 belongs to Category ID 18 (الفلسفة)
            [19, 19], // Course ID 19 belongs to Category ID 19 (علم النفس)
            [20, 20], // Course ID 20 belongs to Category ID 20 (القانون)
            [21, 21], // Course ID 21 belongs to Category ID 21 (التسويق والإعلان)
            [22, 22], // Course ID 22 belongs to Category ID 22 (الاقتصاد وإدارة الأعمال)
            // Add more associations as needed
        ];

        foreach ($categoryCourseAssociations as $association) {
            DB::table('category_course')->insert([
                'course_id' => $association[0],
                'category_id' => $association[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
