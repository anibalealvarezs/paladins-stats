<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loadouts', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name', 64)->nullable();
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
        Schema::dropIfExists('loadouts');
    }
}
