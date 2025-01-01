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
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('sampul')->nullable();
            $table->string('pinPict')->nullable();
            $table->string('title')->default('Pined');
            $table->string('poster')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('sampul');
            $table->dropColumn('pinPict');
            $table->dropColumn('title');
            $table->dropColumn('poster');
        });
    }
};
