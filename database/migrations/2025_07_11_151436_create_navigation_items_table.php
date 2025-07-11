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
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('navigation_menu_id')->constrained()->onDelete('cascade');
            $table->json('label'); // Translatable field
            $table->string('url')->nullable();
            $table->string('target')->default('_self'); // _self, _blank, etc.
            $table->foreignId('parent_id')->nullable()->constrained('navigation_items')->onDelete('cascade');
            $table->integer('order_column')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('custom_attributes')->nullable(); // For additional attributes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
    }
};
