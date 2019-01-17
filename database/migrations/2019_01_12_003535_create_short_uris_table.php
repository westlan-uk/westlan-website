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
            $table->string('name')->length(80)->unique()->nullable(false);
            $table->string('shortcode')->length(20)->unique()->nullable(false);
            $table->string('uri')->nullable(false);
            $table->integer('clicked')->default(0);
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
