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
        Schema::create('materi_rombels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rombel_mapel_guru_id');
            $table->bigInteger('materi_guru_id');
            $table->bigInteger('rombel_id');
            $table->bigInteger('progres')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_rombels');
    }
};
