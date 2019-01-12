<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->default(3);
            $table->string('name');
            $table->string('username')->length(191)->unique();
            $table->string('email')->length(191)->unique();
            $table->string('password');
            $table->string('location');
            $table->timestamp('dob');
            $table->boolean('consent_returned');
            $table->string('mobile');
            $table->boolean('mailing_list');
            $table->boolean('email_flagged');
            $table->timestamp('last_login')->useCurrent();
            $table->string('date_format');
            $table->string('banned_reason');
            $table->boolean('site_upgraded')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
