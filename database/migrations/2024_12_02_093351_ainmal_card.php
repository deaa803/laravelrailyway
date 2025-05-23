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
        Schema::create('animal_card', function (Blueprint $table) {
            $table->id();
            $table->string('time_of_shaving');
            $table->string('time_of_vaccination');
            $table->string('time_of_vest-vet');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_card');
    }
};
