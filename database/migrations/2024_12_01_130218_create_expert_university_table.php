<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('expert_university', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_id');
            $table->unsignedBigInteger('university_id');
            $table->timestamps();

            $table->foreign('expert_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_university');
    }
};
