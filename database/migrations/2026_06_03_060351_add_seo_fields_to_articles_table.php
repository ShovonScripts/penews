<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('focus_keywords')->nullable()->after('meta_description');
            $table->string('canonical_url')->nullable()->after('og_image');
            $table->boolean('indexable')->default(true)->after('canonical_url');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['focus_keywords', 'canonical_url', 'indexable']);
        });
    }
};
