<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cloudinary_public_id')->unique();
            $table->string('secure_url', 500);
            $table->string('resource_type', 30)->default('image'); // image, video, raw
            $table->string('format', 20)->nullable(); // jpg, png, webp, mp4, pdf
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedBigInteger('bytes')->nullable();
            $table->string('alt_text', 255)->nullable();
            $table->timestamps();

            $table->index('resource_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_assets');
    }
};
