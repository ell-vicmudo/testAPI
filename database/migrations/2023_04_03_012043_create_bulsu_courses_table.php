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
        Schema::create('bulsu_courses', function (Blueprint $table) {
            $table->id();
            $table->mediumText('course_title');
            $table->unsignedBigInteger('college_id');

            $table->foreign('college_id')
            ->references('id')
            ->on('bulsu_colleges')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulsu_courses');
    }
};
