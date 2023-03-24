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
        Schema::create('bulsu_sub_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goal_id');
            $table->string('subgoal_num');
            $table->text('title');
            $table->mediumText('description');
            $table->timestamps();

            $table->foreign('goal_id')
            ->references('id')
            ->on('bulsu_goals')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulsu_sub_goals');
    }
};
