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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->boolean('active');
            $table->dateTime('registration_date');
            $table->unsignedBigInteger('politic_party_id');
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->timestamps();
            $table->foreign('politic_party_id')->references('id')->on('political_parties');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
