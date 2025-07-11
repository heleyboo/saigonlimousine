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
        Schema::table('media', function (Blueprint $table) {
            $table->renameColumn('mediable_type', 'model_type');
            $table->renameColumn('mediable_id', 'model_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->renameColumn('model_type', 'mediable_type');
            $table->renameColumn('model_id', 'mediable_id');
        });
    }
};
