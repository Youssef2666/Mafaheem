<?php

use App\Models\User;
use App\Models\RoadMap;
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
        Schema::create('rating_roadmap', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RoadMap::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->tinyInteger('rating')->comment('Rating value between 1 and 5');
            $table->unique(['user_id', 'road_map_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_roadmap');
    }
};
