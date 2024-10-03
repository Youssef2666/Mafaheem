<?php

use App\Models\User;
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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'instructor_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date'); 
            $table->time('time'); 
            $table->integer('capacity')->unsigned();
            $table->decimal('price', 8, 2)->nullable();
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
