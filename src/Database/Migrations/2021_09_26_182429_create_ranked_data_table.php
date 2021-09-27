<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranked_data', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->unsignedInteger('player_id');
            $table->integer('leaves')->default(0);
            $table->integer('losses')->default(0);
            $table->integer('points')->default(0);
            $table->integer('rank')->default(0);
            $table->integer('prev_rank')->default(0);
            $table->unsignedTinyInteger('season')->default(0);
            $table->tinyInteger('tier')->default(0);
            $table->integer('trend')->default(0);
            $table->integer('wins')->default(0);
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
        Schema::dropIfExists('ranked_data');
    }
}
