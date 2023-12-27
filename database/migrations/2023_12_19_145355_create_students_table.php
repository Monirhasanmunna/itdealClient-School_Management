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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('academic_classes')->onDelete('cascade');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->string('roll');
            $table->string('image')->nullable();
            $table->string('phone_number');
            $table->string('dob')->nullable();
            $table->enum('religion',['Islam','Hinduism','Buddist','Christian','Other']);
            $table->enum('gender',['Male','Female','Other']);
            $table->string('blood_group');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('guardian_phone');
            $table->string('district');
            $table->string('upazila');
            $table->string('post_office');
            $table->string('village');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
