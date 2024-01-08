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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('hrm_departments')->onDelete('cascade');
            $table->foreignId('designation_id')->constrained('designations')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone');
            $table->string('dob');
            $table->enum('religion',['Islam','Hinduism','Buddist','Christian','Other']);
            $table->enum('gender',['Male','Female','Other']);
            $table->string('blood_group');
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
        Schema::dropIfExists('staff');
    }
};
