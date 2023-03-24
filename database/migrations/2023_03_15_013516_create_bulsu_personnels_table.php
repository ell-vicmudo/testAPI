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
        Schema::create('bulsu_personnels', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique()->nullable();
            $table->text('name');
            $table->text('position');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('campus_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('local')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulsu_personnels');
    }
};
