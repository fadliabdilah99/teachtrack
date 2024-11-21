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
        Schema::table('user_materi_gurus', function (Blueprint $table) {
            $table->bigInteger('question_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_materi_gurus', function (Blueprint $table) {
            $table->dropColumn('question_id');
        });
    }
};
