<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The contact form already treats phone as optional, but the column was NOT NULL
     * with no default — so a submission without a phone number crashed. Make it nullable.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
        });
    }
};
