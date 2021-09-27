<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('player_id');
            $table->string('name', 64);
            $table->unsignedInteger('avatar_id');
            $table->string('avatar_url', 256);
            $table->dateTime('created_datetime');
            $table->integer('hours_played')->default(0);
            $table->dateTime('last_login_datetime');
            $table->integer('leaves')->default(0);
            $table->integer('level')->default(0);
            $table->string('loading_frame', 64)->nullable();
            $table->integer('losses')->default(0);
            $table->integer('mastery_level')->default(0);
            $table->string('merged_players', 512)->nullable();
            $table->integer('minutes_played')->default(0);
            $table->string('status_message', 512)->nullable();
            $table->string('platform', 32);
            $table->string('region', 64);
            $table->unsignedInteger('team_id')->default(0);
            $table->string('team_name', 64);
            $table->integer('tier_contest')->default(0);
            $table->integer('tier_ranked_controller')->default(0);
            $table->integer('tier_ranked_kbm')->default(0);
            $table->string('title', 64);
            $table->integer('achievements')->default(0);
            $table->bigInteger('worshippers')->default(0);
            $table->bigInteger('xp')->default(0);
            $table->integer('wins')->default(0);
            $table->string('hz_gamer_tag', 64)->nullable();
            $table->string('hz_player_name', 64)->nullable();
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
        Schema::dropIfExists('players');
    }
}
