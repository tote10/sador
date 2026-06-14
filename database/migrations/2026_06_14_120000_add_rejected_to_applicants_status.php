<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Add 'rejected' to the applicants.status enum so admins can reject applicants.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('new', 'reviewed', 'interviewed', 'hired', 'rejected') NOT NULL DEFAULT 'new'");
    }

    /**
     * Reverse the migration. Any existing 'rejected' rows are reset to 'new' first
     * so the column can be narrowed without data-truncation errors.
     */
    public function down(): void
    {
        DB::statement("UPDATE applicants SET status = 'new' WHERE status = 'rejected'");
        DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('new', 'reviewed', 'interviewed', 'hired') NOT NULL DEFAULT 'new'");
    }
};
