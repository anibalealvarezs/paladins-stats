<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champion_ranks', function (Blueprint $table) {
            $table->id();
            $table->integer('assists')->default(0);
            $table->integer('deaths')->default(0);
            $table->integer('gold')->default(0);
            $table->integer('kills')->default(0);
            $table->dateTime('last_played');
            $table->integer('losses')->default(0);
            $table->integer('minion_kills')->default(0);
            $table->integer('minutes')->default(0);
            $table->integer('rank')->default(0);
            $table->integer('wins')->default(0);
            $table->integer('worshippers')->default(0);
            $table->unsignedInteger('champion_id');
            $table->unsignedInteger('player_id');
            $table->string('ret_msg', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('champion_ranks');
    }
}
