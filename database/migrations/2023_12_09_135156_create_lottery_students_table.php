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
        Schema::create('lottery_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('sessions');
            $table->string('applicant_id')->unique();
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone_number');
            $table->enum('religion',['islam','hindu','christian']);
            $table->enum('gender',['male','female','other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_students');
    }
};
