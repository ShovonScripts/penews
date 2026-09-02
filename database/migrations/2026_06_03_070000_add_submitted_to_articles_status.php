<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE articles MODIFY COLUMN status ENUM('draft', 'published', 'scheduled', 'submitted', 'archived') DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE articles MODIFY COLUMN status ENUM('draft', 'published', 'scheduled', 'archived') DEFAULT 'draft'");
    }
};
