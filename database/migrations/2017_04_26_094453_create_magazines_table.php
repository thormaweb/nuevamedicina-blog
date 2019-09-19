<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Month YYYY
            $table->string('slug')->unique(); // YYYY-month
            $table->integer('order'); // YYYYMM
            $table->string('description');
            $table->string('keywords');
            $table->string('thumbnail');
            $table->string('pdf');
            $table->timestamp('published_on');
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
        Schema::dropIfExists('magazines');
    }
}
