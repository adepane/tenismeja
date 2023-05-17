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
        Schema::table('match_sets', function (Blueprint $table) {
            $table->integer('home_win')->default(0)->after('set_of_match');
            $table->integer('away_win')->default(0)->after('home_win');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_sets', function (Blueprint $table) {
            $table->dropColumn('home_win');
            $table->dropColumn('away_win');
        });
    }
};
