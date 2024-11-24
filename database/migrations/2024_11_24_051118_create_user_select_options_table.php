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
        Schema::create('user_select_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id');
            $table->bigInteger('option_id');
            $table->bigInteger('user_materi_guru_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_select_options');
    }
};
