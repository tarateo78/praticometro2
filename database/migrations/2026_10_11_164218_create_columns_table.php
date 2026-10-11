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
        Schema::create('columns', function (Blueprint $table) {

            $table->string('nome_column', 6)->primary();
            $table->string('titolo_column')->nullable();
            $table->integer('is_selezionabile')->default(0);
            $table->integer('is_visibile')->default(0);
            $table->integer('order')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('columns');
    }
};
