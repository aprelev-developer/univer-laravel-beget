<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('form_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->json('data'); // Хранение данных формы в формате JSON
            $table->double('score')->nullable(); // Поле для хранения рассчитанного балла
            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('form_entries');
    }
};
