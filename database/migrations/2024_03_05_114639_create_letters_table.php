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
    Schema::create('letters', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('student_id');
      $table->dateTime('date');
      $table->string('duration');
      $table->string('type');
      $table->string('category');
      $table->string('status');
      $table->string('letter_document');
      $table->string('support_document')->nullable();
      $table->timestamps();

      $table->foreign('student_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('letters');
  }
};
