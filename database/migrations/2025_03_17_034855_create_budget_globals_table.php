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
        // Cette migration doit être exécutée AVANT toute migration qui référence budget_globals
        Schema::create('budget_globals', function (Blueprint $table) {
            $table->id();
            $table->float('montant_total')->default(0);
            $table->string('statut')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_globals');
    }
};
