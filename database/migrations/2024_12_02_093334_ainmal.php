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
        if (!Schema::hasTable('users')) {
            Schema::create('animal', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->string('name');
                $table->string('age')->nullable();
                $table->date('date');
                $table->string('animal_type');
                $table->string('image')->nullable();
                $table->date('clinic_appointment')->nullable();   //مشان تخزين الموعد اذا حدد
                $table->boolean('reminder_enabled')->default(false);//مشان اذا بدو يفعل اشعارات او لاء
                $table->date('last_reminder_sent')->nullable();//اخر اشعار
                $table->foreign('user_id')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal');
    }
};
