<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_sets', function (Blueprint $table) {
            $table->id();
            $table->integer('player_match_id');
            $table->integer('home_score')->default(0);
            $table->integer('away_score')->default(0);
            $table->integer('finish')->default(0);
            $table->integer('set_of_match');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_sets');
    }
};
