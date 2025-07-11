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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // Translatable fields
            $table->json('title');
            $table->json('slug');
            $table->json('short_description');
            $table->json('content');
            $table->json('meta_title');
            $table->json('meta_description');
            
            // Post metadata
            $table->enum('type', ['destination', 'travel_tips', 'itinerary', 'promotion', 'review'])->default('destination');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order_column')->nullable();
            
            // Relationships
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedBigInteger('related_service_id')->nullable();
            
            // SEO and tracking
            $table->integer('view_count')->default(0);
            $table->string('seo_keywords')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['type', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
