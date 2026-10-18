<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // e.g., "The Hearth Phnom Penh"
            $table->string('slug')->unique();   // e.g., "the-hearth-phnom-penh"
            $table->string('category');         // e.g., "City Center"
            $table->string('location');         // e.g., "Phnom Penh, Cambodia"
            $table->decimal('starting_rate');   // e.g., 250.00
            $table->text('overview');           // Short summary
            $table->longText('description');    // Full details
            $table->json('amenities');          // Array like ["Pool", "Spa"]
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
