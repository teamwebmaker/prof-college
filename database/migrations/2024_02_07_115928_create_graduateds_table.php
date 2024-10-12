<?php

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
        Schema::create('graduateds', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('poster') -> nullable();
            $table->string('image') -> nullable();
            $table->string('description') -> nullable();
            $table->enum('visibility',['0', '1']) -> default('1');
            $table->tinyInteger('sortable') -> default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduateds');
    }
};
