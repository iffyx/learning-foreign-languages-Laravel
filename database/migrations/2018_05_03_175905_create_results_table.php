<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('result')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('set_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('results', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('set_id')->references('id')->on('sets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
