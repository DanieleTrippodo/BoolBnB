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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign Key user_id
            $table->text('title'); // Title field
            $table->smallInteger('rooms_num'); // Number of rooms (integer)
            $table->smallInteger('beds_num'); // Number of beds (integer)
            $table->smallInteger('bathroom_num'); // Number of bathrooms (integer)
            $table->smallInteger('sq_mt'); // Square meters (small integer)
            $table->string('address', 255); // Address (string)
            $table->decimal('latitude', 8, 6); // Latitude (decimal)
            $table->decimal('longitude', 9, 6); // Longitude (decimal)
            $table->text('images')->nullable(); // Image path (string, optional)
            $table->boolean('visibility')->default(true); // Visibility status (boolean)
            $table->timestamps(); // Timestamps for created_at and updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Prima rimuovi la foreign key
         Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Elimina la tabella
        Schema::dropIfExists('apartments');

    }
};
