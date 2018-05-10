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


        DB::table('results')->insert(
            array(
                'result' => 20,
                'user_id' => 1,
                'set_id' => 2,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        DB::table('results')->insert(
            array(
                'result' => 50,
                'user_id' => 1,
                'set_id' => 2,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        DB::table('results')->insert(
            array(
                'result' => 35,
                'user_id' => 1,
                'set_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        DB::table('results')->insert(
            array(
                'result' => 80,
                'user_id' => 1,
                'set_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        DB::table('results')->insert(
            array(
                'result' => 90,
                'user_id' => 1,
                'set_id' => 3,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        DB::table('results')->insert(
            array(
                'result' => 40,
                'user_id' => 1,
                'set_id' => 3,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        DB::table('results')->insert(
            array(
                'result' => 80,
                'user_id' => 1,
                'set_id' => 3,
                'created_at' => date('Y-m-d H:i:s')
            )
        );


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
