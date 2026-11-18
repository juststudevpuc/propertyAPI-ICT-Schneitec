<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Discriminator: 'care_slide' | 'brokerage_protocol'
            $table->string('section_type', 50)->default('care_slide')->index();

            // Controls display order on the public Services page
            $table->unsignedInteger('sort_order')->default(0);

            // Primary editorial headings
            $table->string('tab_name')->nullable(); // e.g. "01 / Home Check-Up" or "PROTOCOL 01 // SUBSIDIARY"
            $table->string('title');                // e.g. "Precision Home Inspection"
            $table->string('subtitle')->nullable(); // e.g. "Structural Assurance & Performance"
            $table->text('intro')->nullable();      // Main narrative paragraph

            // Repeatable bullet points & footnote
            $table->json('bullets')->nullable();
            $table->string('footnote')->nullable();

            // Direct image URL (decoupled from any media library)
            $table->string('image_url', 500)->nullable();

            // Dedicated Stewardship Desk contact details (used by care_slide)
            $table->string('contact_desk')->nullable();
            $table->string('contact_phone', 100)->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_hours', 150)->nullable();

            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
