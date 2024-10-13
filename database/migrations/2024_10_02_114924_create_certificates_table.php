<?php

use App\Models\User;
use App\Models\Course;
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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Course::class);
            $table->date('issued_at');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('code')->unique()->nullable()->comment('Unique code for the certificate');
            $table->string('download_link')->nullable();
            $table->unique(['user_id', 'course_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
