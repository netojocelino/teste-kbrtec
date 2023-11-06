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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();

            $table->string('code')->index();
            $table->string('full_name');
            $table->date('birthdate');
            $table->string('document_number')->comment('CPF do atleta')->unique();
            $table->string('team');
            $table->string('gender')->comment('male | female');
            $table->string('belt')->comment('marrom | preta');
            $table->string('weight')->comment('leve | pesado');

            $table->string('email')->unique();
            $table->string('password');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
