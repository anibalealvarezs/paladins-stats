<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champions', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->primary('id');
            $table->string('name', 64);
            $table->string('name_english', 64);
            $table->boolean('on_rotation')->default(false);
            $table->boolean('on_weekly_rotation')->default(false);
            $table->string('card_url', 256)->nullable();
            $table->string('icon_url', 256)->nullable();
            $table->string('cons', 1024)->nullable();
            $table->string('pros', 1024)->nullable();
            $table->string('lore', 1024)->nullable();
            $table->string('pantheon', 64)->nullable();
            $table->integer('health');
            $table->string('roles', 64);
            $table->integer('speed');
            $table->string('title', 128)->nullable();
            $table->string('type', 256)->nullable();
            $table->string('latest_champion', 16)->nullable();
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
        Schema::dropIfExists('champions');
    }
}
