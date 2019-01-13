<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('site_admin')->default(0);
            $table->boolean('gallery_admin')->default(0);
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'site_admin' => true,
                'gallery_admin' => true
            ],
            [
                'name' => 'Gallery Admin',
                'site_admin' => false,
                'gallery_admin' => true
            ],
            [
                'name' => 'User',
                'site_admin' => false,
                'gallery_admin' => false
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
