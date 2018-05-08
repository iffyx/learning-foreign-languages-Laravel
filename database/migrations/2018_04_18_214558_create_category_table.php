<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                'name' => 'Nauka',
                'description' => 'opis kat 1'
            )
        );

        DB::table('categories')->insert(
            array(
                'name' => 'Zdrowie',
                'description' => 'opis kat 2'
            )
        );

        DB::table('categories')->insert(
            array(
                'name' => 'Natura',
                'description' => 'opis kat 3'
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
        Schema::dropIfExists('categories');
    }
}
