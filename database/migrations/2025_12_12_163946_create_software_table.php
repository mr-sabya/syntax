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
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->foreignId('software_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('version')->nullable(); // e.g., v2.0

            // Content
            $table->text('short_description')->nullable(); // For cards
            $table->longText('long_description')->nullable(); // For detail page (Rich Text)
            $table->json('features')->nullable(); // Store list of features ["Fast", "Secure"]

            // Media
            $table->string('logo')->nullable(); // Square icon
            $table->string('banner_image')->nullable(); // Large cover image

            // Links
            $table->string('demo_url')->nullable();
            $table->string('download_url')->nullable();
            $table->string('purchase_url')->nullable();
            $table->decimal('price', 10, 2)->nullable();

            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software');
    }
};
