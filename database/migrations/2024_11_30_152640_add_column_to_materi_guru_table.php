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
        Schema::table('materi_gurus', function (Blueprint $table) {
            $table->bigInteger('guru_mapel_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materi_gurus', function (Blueprint $table) {
            $table->dropColumn('guru_mapel_id');
        });
    }
};
