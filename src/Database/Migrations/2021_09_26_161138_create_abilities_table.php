<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ability_id');
            $table->string('name', 64);
            $table->text('description');
            $table->text('summary');
            $table->string('url', 256);
            $table->string('damage_type', 32);
            $table->integer('recharge_seconds')->default(0);
            $table->unsignedInteger('champion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abilities');
    }
}
