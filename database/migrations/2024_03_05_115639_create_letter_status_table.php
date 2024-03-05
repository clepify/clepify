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
    Schema::create('letter_status', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('letter_id');
      $table->unsignedBigInteger('user_id');
      $table->string('status_before');
      $table->string('status_after');
      $table->timestamps();

      $table->foreign('letter_id')->references('id')->on('letters')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('letter_status');
  }
};
