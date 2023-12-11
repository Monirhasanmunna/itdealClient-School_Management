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
            $table->string('applicant_id')->unique();
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone_number');
            $table->enum('religion',['Islam','Hinduism','Buddist','Christian','Other']);
            $table->enum('gender',['Male','Female','Other']);
            $table->boolean('isSelected')->default(false);
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
