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
        Schema::create('materi_gurus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('judul');
            $table->string('jenis');
            $table->integer('menit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_gurus');
    }
};
