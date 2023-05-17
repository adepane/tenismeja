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
        Schema::table('player_matchs', function (Blueprint $table) {
            $table->boolean('finish')->default(false)->after('away_id');
            $table->integer('home_score')->default(0)->after('finish');
            $table->integer('away_score')->default(0)->after('home_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_matchs', function (Blueprint $table) {
            $table->dropColumn('finish');
            $table->dropColumn('home_score');
            $table->dropColumn('away_score');
        });
    }
};
