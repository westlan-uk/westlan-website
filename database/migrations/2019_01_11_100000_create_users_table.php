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
            $table->string('location')->nullable();
            $table->timestamp('dob')->nullable();
            $table->boolean('consent_returned')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('mailing_list')->default(0);
            $table->boolean('email_flagged')->default(0);
            $table->timestamp('last_login')->useCurrent();
            $table->string('date_format')->nullable();
            $table->string('banned_reason')->nullable();
            $table->boolean('site_upgraded')->default(1);
            $table->string('display_pic')->nullable();
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
