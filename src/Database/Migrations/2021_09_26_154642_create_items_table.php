<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_id');
            $table->text('description');
            $table->string('device_name', 64)->nullable();
            $table->unsignedInteger('icon_id')->default(0);
            $table->unsignedInteger('price');
            $table->string('short_desc', 256)->nullable();
            $table->unsignedInteger('champion_id')->default(0);
            $table->string('icon_url', 1024)->nullable();
            $table->string('type', 64)->nullable();
            $table->unsignedInteger('recharge_seconds');
            $table->string('ret_msg', 1024)->nullable();
            $table->integer('talent_reward_level')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
