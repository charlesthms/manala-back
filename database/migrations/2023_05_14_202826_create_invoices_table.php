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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->foreignUuid('client_id')->constrained();
            $table->foreignId('pension_id')->constrained();
            $table->foreignId('horse_id')->constrained();
            $table->tinyInteger('status'); // 0 = en attente, 1 = confirmée, 2 = envoyée, 3 = payée
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
