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
        Schema::create('apartment_service', function (Blueprint $table) {

            $table->id();// Foreign key for apartments
            $table->foreignId('apartment_id')->constrained('apartments')->onDelete('cascade');// Foreign key for services
            $table->foreignId('extra_service_id')->constrained('extra_service')->onDelete('cascade');
            $table->timestamps(); // Se desideri mantenere il timestamp per la creazione e modifica

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('apartments_service', function (Blueprint $table) {
            $table->dropForeign(['apartment_id']); // Elimina la foreign key per user_id
            $table->dropForeign(['extra_service_id']);
        });


        Schema::dropIfExists('apartment_service');
    }
};
