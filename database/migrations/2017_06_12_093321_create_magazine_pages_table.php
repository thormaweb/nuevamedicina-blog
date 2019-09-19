<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('magazine_id')->unsigned();
            $table->integer('order')->nullable();
            $table->string('src');
            $table->string('thumb');
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazine_pages');
    }
}
