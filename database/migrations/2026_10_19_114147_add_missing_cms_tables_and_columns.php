<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create the 3 Missing Tables
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('name');
            $table->string('role');
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('year')->nullable();
            $table->string('icon_name', 50)->nullable();
            $table->string('award_type', 50)->default('studio');
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group', 50)->default('general')->index();
            $table->timestamps();
        });

        // 2. Add the Missing Columns to Existing Tables
        Schema::table('offers', function (Blueprint $table) {
            $table->string('cta_link')->nullable()->after('description');
            $table->boolean('is_published')->default(true)->after('cta_link');
            $table->integer('display_order')->default(0)->after('is_published');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->string('cta_link')->nullable()->after('description');
            $table->boolean('is_published')->default(true)->after('cta_link');
            $table->integer('display_order')->default(0)->after('is_published');
        });

        Schema::table('job_openings', function (Blueprint $table) {
            $table->boolean('is_published')->default(true)->after('apply_link');
            $table->integer('display_order')->default(0)->after('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('site_settings');

        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn(['cta_link', 'is_published', 'display_order']);
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn(['cta_link', 'is_published', 'display_order']);
        });

        Schema::table('job_openings', function (Blueprint $table) {
            $table->dropColumn(['is_published', 'display_order']);
        });
    }
};
