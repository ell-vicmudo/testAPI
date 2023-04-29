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
        Schema::create('bulsu__announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('publisher');
            $table->date('date');
            $table->mediumText('body')->nullable();
            $table->string('image', 255)->unique()->nullable();
            $table->string('attachment', 255)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulsu_announcements');
    }
};
