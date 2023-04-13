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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('box');
            $table->boolean('active');
            $table->unsignedBigInteger('payroll_id');
            $table->unsignedBigInteger('voter_id');
            $table->timestamps();
            $table->foreign('payroll_id')->references('id')->on('payrolls');
            $table->foreign('voter_id')->references('id')->on('voters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
