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
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE applicants DROP CONSTRAINT IF EXISTS applicants_status_check');
            DB::statement("ALTER TABLE applicants ADD CONSTRAINT applicants_status_check CHECK (status IN ('new', 'reviewed', 'interviewed', 'hired', 'rejected'))");

            return;
        }

        DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('new', 'reviewed', 'interviewed', 'hired', 'rejected') NOT NULL DEFAULT 'new'");
    }

    /**
     * Reverse the migration. Any existing 'rejected' rows are reset to 'new' first
     * so the column can be narrowed without data-truncation errors.
     */
    public function down(): void
    {
        DB::statement("UPDATE applicants SET status = 'new' WHERE status = 'rejected'");

        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE applicants DROP CONSTRAINT IF EXISTS applicants_status_check');
            DB::statement("ALTER TABLE applicants ADD CONSTRAINT applicants_status_check CHECK (status IN ('new', 'reviewed', 'interviewed', 'hired'))");

            return;
        }

        DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('new', 'reviewed', 'interviewed', 'hired') NOT NULL DEFAULT 'new'");
    }
};
