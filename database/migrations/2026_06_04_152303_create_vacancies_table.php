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
    Schema::create('vacancies', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('type');                    // Full-Time, Contract, etc.
        $table->string('location');
        $table->string('experience');
        $table->string('education')->nullable();
        $table->string('salary')->nullable();
        $table->longText('description');
        $table->boolean('is_open')->default(true);
        $table->date('deadline')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
