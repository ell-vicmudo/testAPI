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
        Schema::create('bulsu_bacs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->unsignedBigInteger('type_id');
            $table->text('body');
            $table->string('file')->unique()->nullable();
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('type_id')
            ->references('id')
            ->on('bulsu_bac_types')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulsu_bacs');
    }
};
