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
        Schema::create('competitor_groups', function (Blueprint $table) {
            $table->id();

            $table->string('belt');
            $table->string('weight');

            $table->integer('match_number');
            $table->integer('match_level')->default(1);

            $table->integer('championship_id')->unsigned()->nullable();
            $table->integer('first_athlete_id')->unsigned()->nullable();
            $table->integer('second_athlete_id')->unsigned()->nullable();
            $table->integer('winner_athlete_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitor_groups');
    }
};
