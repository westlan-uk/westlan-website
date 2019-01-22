<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seating_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seating_plan_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('pos_x')->unsigned();
            $table->integer('pos_y')->unsigned();
            $table->integer('width')->unsigned()->default(1);
            $table->integer('height')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('seating_plan_id')->references('id')->on('seating_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seating_items');
    }
}
