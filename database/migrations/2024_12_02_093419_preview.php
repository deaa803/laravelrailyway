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
       if (!Schema::hasTable('vet')) {
           Schema::create('preview', function (Blueprint $table) {
               $table->foreign('vet_id')->references('id')->on('vets')->onDelete('cascade');
               $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
               $table->primary(['vet_id', 'animal_id']);
               $table->string('description');
           });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('preview');
    }
};
