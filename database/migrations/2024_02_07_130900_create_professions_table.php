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
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->string('image')->nullable();
            $table->json('type')->nullable();
            $table->json('condition')->nullable();
            $table->string('level')->nullable();
            $table->string('credits')->nullable();
            $table->string('custom_credits')->nullable();
            $table->string('duration')->nullable();
            $table->string('custom_duration')->nullable();
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
        Schema::dropIfExists('professions');
    }
};
