<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id');
            $table->unsignedInteger('champion_id');
            $table->unsignedInteger('player_id');
            $table->unsignedInteger('item_1');
            $table->unsignedInteger('item_2');
            $table->unsignedInteger('item_3');
            $table->unsignedInteger('item_4');
            $table->unsignedInteger('item_level_1');
            $table->unsignedInteger('item_level_2');
            $table->unsignedInteger('item_level_3');
            $table->unsignedInteger('item_level_4');
            $table->integer('assists')->default(0);
            $table->integer('creeps')->default(0);
            $table->integer('damage')->default(0);
            $table->integer('damage_bot')->default(0);
            $table->integer('damage_done_in_hand')->default(0);
            $table->integer('damage_mitigated')->default(0);
            $table->integer('damage_structure')->default(0);
            $table->integer('damage_taken')->default(0);
            $table->integer('damage_taken_magical')->default(0);
            $table->integer('damage_taken_physical')->default(0);
            $table->integer('deaths')->default(0);
            $table->integer('distance_traveled')->default(0);
            $table->integer('gold')->default(0);
            $table->integer('healing')->default(0);
            $table->integer('healing_bot')->default(0);
            $table->integer('healing_player_self')->default(0);
            $table->unsignedInteger('talent1')->default(0);
            $table->unsignedInteger('talent2')->default(0);
            $table->unsignedInteger('talent3')->default(0);
            $table->unsignedInteger('talent4')->default(0);
            $table->unsignedInteger('talent5')->default(0);
            $table->unsignedInteger('talent6')->default(0);
            $table->integer('kills')->default(0);
            $table->integer('killing_spree')->default(0);
            $table->integer('level')->default(0);
            $table->integer('multikill_max')->default(0);
            $table->integer('objective_assists')->default(0);
            $table->string('skin', 128);
            $table->unsignedInteger('skin_id');
            $table->integer('surrendered')->default(0);
            $table->unsignedInteger('task_force')->default(0);
            $table->integer('team1_score')->default(0);
            $table->integer('team2_score')->default(0);
            $table->integer('time_in_match')->default(0);
            $table->integer('wards_placed')->default(0);
            $table->string('win_status', 32);
            $table->unsignedInteger('winning_task_force')->default(0);
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
        Schema::dropIfExists('match_players');
    }
}
