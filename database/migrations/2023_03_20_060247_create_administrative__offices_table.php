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
        Schema::create('administrative__offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bulsu_personnel_id');
            $table->text('admin_offices');
            $table->timestamps();

            $table->foreign('bulsu_personnel_id')
            ->references('id')
            ->on('bulsu_personnels')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrative__offices');
    }
};
