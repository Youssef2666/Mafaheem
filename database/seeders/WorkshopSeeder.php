<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshops = [
            [
                'instructor_id' => 1,
                'title' => 'Laravel 9: The Laravel Framework',
                'description' => 'Laravel 9: The Laravel Framework',
                'created_at' => now(),
                'updated_at' => now(),
                'date' => '2025-01-01',
                'time' => '09:00:00',
                'capacity' => 10,
                'price' => 20,
            ],
            [
                'instructor_id' => 1,
                'title' => 'Laravel 10: The Laravel Framework',
                'description' => 'Laravel 10: The Laravel Framework',
                'created_at' => now(),
                'updated_at' => now(),
                'date' => '2024-12-22',
                'time' => '10:00:00',
                'capacity' => 10,
                'price' => 20,
            ],
            [
                'instructor_id' => 1,
                'title' => 'Laravel 11: The Laravel Framework',
                'description' => 'Laravel 11: The Laravel Framework',
                'created_at' => now(),
                'updated_at' => now(),
                'date' => '2024-11-5',
                'time' => '11:00:00',
                'capacity' => 10,
                'price' => 20,
            ],
        ];
        foreach ($workshops as $workshop) {
            \App\Models\Workshop::create($workshop);
        }
    }
}
