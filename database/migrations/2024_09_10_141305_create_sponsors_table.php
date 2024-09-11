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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Colonna per il nome del piano di sponsorizzazione
            $table->smallInteger('duration'); // Durata della sponsorizzazione
            $table->decimal('cost', 5, 2); // Costo della sponsorizzazione
            $table->timestamps(); // Timestamp per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};