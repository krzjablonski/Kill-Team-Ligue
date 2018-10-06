<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('PlayerA_id')->unsigned();
            $table->integer('PlayerB_id')->unsigned();
            $table->integer('winner')->nullable();
            $table->integer('round_num')->nullable();
            $table->boolean('isUsed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parings');
    }
}
