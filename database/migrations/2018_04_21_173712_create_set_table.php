<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('set');
            $table->integer('language1_id')->unsigned()->nullable();
            $table->integer('language2_id')->unsigned()->nullable();
            $table->integer('number_if_words')->unsigned();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('sets', function($table) {
            $table->foreign('subcategory_id')->references('id')->on('subcategory')->onDelete('set null');
            $table->foreign('language1_id')->references('id')->on('languages')->onDelete('set null');
            $table->foreign('language2_id')->references('id')->on('languages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sets');
    }
}
