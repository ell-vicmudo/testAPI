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
        Schema::create('bulsu_news', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('publisher');
            $table->date('publish_date');
            $table->binary('thumbnail')->nullable();
            $table->text('heading');
            $table->longText('body');
            $table->boolean('Visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulsu_news');
    }
};
