<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'tagline')) {
                $table->string('tagline')->nullable()->after('category');
            }
            if (!Schema::hasColumn('projects', 'starting_price')) {
                $table->string('starting_price', 100)->nullable()->after('tagline');
            }
            if (!Schema::hasColumn('projects', 'cover_image')) {
                $table->string('cover_image', 500)->nullable()->after('starting_price');
            }
            if (!Schema::hasColumn('projects', 'video_url')) {
                $table->string('video_url', 500)->nullable()->after('cover_image');
            }

            // Relax original NOT NULL columns so draft residences can save cleanly
            $table->text('overview')->nullable()->change();
            $table->longText('design_approach')->nullable()->change();
            $table->json('highlights')->nullable()->change();

            if (!Schema::hasColumn('projects', 'key_stats')) {
                $table->json('key_stats')->nullable()->after('design_approach');
            }
            if (!Schema::hasColumn('projects', 'house_types')) {
                $table->json('house_types')->nullable()->after('key_stats');
            }
            if (!Schema::hasColumn('projects', 'amenities')) {
                $table->json('amenities')->nullable()->after('house_types');
            }
            if (!Schema::hasColumn('projects', 'gallery_images')) {
                $table->json('gallery_images')->nullable()->after('amenities');
            }
            if (!Schema::hasColumn('projects', 'progress_text')) {
                $table->string('progress_text')->nullable()->after('gallery_images');
            }
            if (!Schema::hasColumn('projects', 'progress_percent')) {
                $table->unsignedTinyInteger('progress_percent')->default(100)->after('progress_text');
            }
            if (!Schema::hasColumn('projects', 'audit_label')) {
                $table->string('audit_label')->nullable()->after('progress_percent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $cols = array_filter([
                'tagline',
                'starting_price',
                'cover_image',
                'video_url',
                'key_stats',
                'house_types',
                'amenities',
                'gallery_images',
                'progress_text',
                'progress_percent',
                'audit_label',
            ], fn ($col) => Schema::hasColumn('projects', $col));

            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
