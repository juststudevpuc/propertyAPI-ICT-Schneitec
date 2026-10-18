<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. News Articles
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_url')->nullable();
            $table->string('date_string')->nullable(); // e.g. "OCTOBER 14, 2023"
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 2. Galleries for Properties & Projects
        Schema::create('property_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
            $table->string('image_url');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('project_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('image_url');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // 3. Offers & Experiences
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('validity');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 4. Careers / Job Openings
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('department');
            $table->string('location');
            $table->string('type')->default('Full-time');
            $table->string('apply_link')->nullable();
            $table->timestamps();
        });

        // 5. Visitor Form Submissions
        Schema::create('booking_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
            $table->date('check_in');
            $table->date('check_out');
            $table->string('guests');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::create('guest_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_visited')->nullable();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_feedbacks');
        Schema::dropIfExists('booking_inquiries');
        Schema::dropIfExists('job_openings');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('project_galleries');
        Schema::dropIfExists('property_galleries');
        Schema::dropIfExists('news_articles');
    }
};
