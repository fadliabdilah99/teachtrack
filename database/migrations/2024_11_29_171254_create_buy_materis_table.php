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
        Schema::create('buy_materis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('materi_guru_id')->nullable();
            $table->bigInteger('sell_materi_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('kodeInvoice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_materis');
    }
};
