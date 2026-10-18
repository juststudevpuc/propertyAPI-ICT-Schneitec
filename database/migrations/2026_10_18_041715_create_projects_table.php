<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');             // e.g., "Modern Luxury Residence"
            $table->string('slug')->unique();    // e.g., "modern-luxury-residence"
            $table->string('category');          // e.g., "Residential"
            $table->text('overview');            // Short summary
            $table->longText('design_approach'); // Detailed design approach text
            $table->json('highlights');          // Array like ["Open-plan living", "Natural light"]
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
