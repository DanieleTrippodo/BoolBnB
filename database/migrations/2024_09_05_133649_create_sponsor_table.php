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
        Schema::create('sponsor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained('apartments')->onDelete('cascade');
            $table->string('sponsorship_plan', 50);
            $table->smallInteger('duration');
            $table->decimal('cost', 3,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('sponsor', function (Blueprint $table) {
            $table->dropForeign(['apartment_id']);
        });

        Schema::dropIfExists('sponsor');
    }
};
