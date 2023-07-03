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
        Schema::create('Prestatie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('OefeningId');
            $table->foreign("OefeningId")->references('id')->on('Oefening')->cascadeOnDelete();
            $table->integer('Aantal');
            $table->unsignedBigInteger('UserId');
            $table->foreign("UserId")->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Oefening');
    }
};
