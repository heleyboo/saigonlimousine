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
        Schema::table('services', function (Blueprint $table) {
            $table->json('slug')->after('name'); // Translatable slug
            $table->json('short_description')->after('description'); // Translatable short description
            $table->decimal('price', 10, 2)->after('short_description'); // Service price
            $table->string('duration')->after('price'); // Service duration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['slug', 'short_description', 'price', 'duration']);
        });
    }
};
