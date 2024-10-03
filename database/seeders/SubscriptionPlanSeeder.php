<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionPlans = [
            [
                'name' => 'Free',
                'price' => 0,
                'duration' => 0
            ],
            [
                'name' => 'Premium',
                'price' => 9.99,
                'duration' => 30
            ],
            [
                'name' => 'Ultimate',
                'price' => 19.99,
                'duration' => 365
            ],
            ];
        foreach ($subscriptionPlans as $subscriptionPlan) {
            SubscriptionPlan::create($subscriptionPlan);
        }
    }
}
