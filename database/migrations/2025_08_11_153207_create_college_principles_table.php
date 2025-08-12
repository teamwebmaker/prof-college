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
        Schema::create('college_principles', function (Blueprint $table) {
            $table->id();
            $table->json('mission');          // Stores mission (multilingual or structured)
            $table->json('vision');           // Stores vision (multilingual or structured)
            $table->json('principles');       // Stores principles (key-value pairs or array)
            $table->timestamps();             // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_principles');
    }
};
