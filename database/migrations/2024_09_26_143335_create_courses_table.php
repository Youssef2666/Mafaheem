<?php

use App\Models\CourseCategory;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignIdFor(SubscriptionPlan::class, 'subscription_plan_id');
            $table->foreignIdFor(User::class, 'instructor_id');
            $table->string('image')->nullable();
            $table->enum('level', ['مبتدئ', 'متوسط', 'متقدم']);
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('duration')->default(0);
            $table->text('what_you_will_learn')->nullable();
            $table->text('requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
