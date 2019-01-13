<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortUrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_uris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length(191)->unique()->nullable(false);
            $table->string('shortcode')->length(191)->unique()->nullable(false);
            $table->string('uri')->nullable(false);
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
        Schema::dropIfExists('short_uris');
    }
}
