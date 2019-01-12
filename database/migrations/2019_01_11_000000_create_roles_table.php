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
            $table->boolean('has_site_admin')->default(0);
            $table->boolean('has_gallery_admin')->default(0);
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'has_site_admin' => true,
                'has_gallery_admin' => true
            ],
            [
                'name' => 'Gallery Admin',
                'has_site_admin' => false,
                'has_gallery_admin' => true
            ],
            [
                'name' => 'User',
                'has_site_admin' => false,
                'has_gallery_admin' => false
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
