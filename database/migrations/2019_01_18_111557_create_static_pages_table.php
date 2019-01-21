<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link')->length(40)->unique();
            $table->longText('content');
            $table->timestamps();
        });

        DB::table('static_pages')->insert([
            [
                'name' => 'Terms &amp; Conditions',
                'link' => 'termsandconditions',
                'content' => ''
            ],
            [
                'name' => 'Privacy Policy',
                'link' => 'privacypolicy',
                'content' => ''
            ],
            [
                'name' => 'Frequently Asked Questions',
                'link' => 'faq',
                'content' => ''
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
        Schema::dropIfExists('static_pages');
    }
}
