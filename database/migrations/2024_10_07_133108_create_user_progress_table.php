<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Lecture;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Course::class);
            $table->foreignIdFor(Lesson::class)->nullable();  // Nullable in case the user is tracking progress at the course level
            $table->foreignIdFor(Lecture::class)->nullable(); // Nullable in case the user is tracking progress at the lesson level
            $table->boolean('completed')->default(false); // Indicates if the user has completed this item
            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
