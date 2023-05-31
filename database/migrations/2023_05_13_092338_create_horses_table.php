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
    Schema::create('horses', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignUuid('client_id')->constrained();
      $table->foreignId('pension_id')->constrained();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('horses');
  }
};
