<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseRoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseRoadmapAssociations = [
            [1, 1],
            [1, 2],  
            [2, 1], 
            [3, 3],  
            [4, 4],  
            [5, 4],  
            [6, 4],  
            [5, 5],  
            [6, 6],  
            [7, 7],  // Course ID 7 belongs to Roadmap ID 7
            [8, 8],  // Course ID 8 belongs to Roadmap ID 8
            [9, 9],  
            // Add more associations as needed
        ];

        foreach ($courseRoadmapAssociations as $association) {
            DB::table('course_roadmap')->insert([
                'course_id' => $association[0],
                'road_map_id' => $association[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
