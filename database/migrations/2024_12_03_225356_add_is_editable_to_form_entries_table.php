<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('form_entries', function (Blueprint $table) {
            $table->boolean('is_editable')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('form_entries', function (Blueprint $table) {
            //
        });
    }
};
