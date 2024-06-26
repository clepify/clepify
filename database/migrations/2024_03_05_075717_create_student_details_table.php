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
    Schema::create('student_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('study_program_id');
      $table->unsignedBigInteger('class_id');
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('study_program_id')->references('id')->on('study_programs');
      $table->foreign('class_id')->references('id')->on('class');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('student_details');
  }
};
