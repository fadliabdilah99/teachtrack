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
        Schema::create('rombel_mapel_gurus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rombel_id')->nullable();
            $table->bigInteger('guru_mapel_id')->nullable();
            $table->integer('dari')->nullable();
            $table->integer('sampai')->nullable();
            $table->string('hari')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombel_mapel_gurus');
    }
};
