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
            $table->boolean('private')->default(false);
            $table->boolean('visible')->default(true);
            $table->integer('language1_id')->unsigned()->nullable();
            $table->integer('language2_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('sets', function ($table) {
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
            $table->foreign('language1_id')->references('id')->on('languages')->onDelete('set null');
            $table->foreign('language2_id')->references('id')->on('languages')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        DB::table('sets')->insert(
            array(
                'name' => 'Podstawowy',
                'set' => 'matematyka;Maths' . PHP_EOL . 'historia;History' . PHP_EOL . 'plastyka;Art' . PHP_EOL . 'biologia;Biology' . PHP_EOL . 'chemia;Chemistry' . PHP_EOL . 'angielski;English' . PHP_EOL . 'geografia;Geography',
                'language1_id' => 1,
                'language2_id' => 2,
                'private' => false,
                'subcategory_id' => 1,
                'user_id' => 1
            )
        );

        DB::table('sets')->insert(
            array(
                'name' => 'Podstawowy',
                'set' => 'gumka;rubber' . PHP_EOL . 'długopis;pen' . PHP_EOL . 'klej;glue' . PHP_EOL . 'książka;book' . PHP_EOL . 'ołówek;pencil' . PHP_EOL . 'mapa;map',
                'language1_id' => 1,
                'language2_id' => 2,
                'private' => false,
                'subcategory_id' => 2,
                'user_id' => 1
            )
        );

        DB::table('sets')->insert(
            array(
                'name' => 'Podstawowy',
                'set' => 'grypa;flu' . PHP_EOL . 'gorączka;fever' . PHP_EOL . 'ból;ache' . PHP_EOL . 'przeziębienie;cold' . PHP_EOL . 'kaszel;cough',
                'language1_id' => 1,
                'language2_id' => 2,
                'private' => false,
                'subcategory_id' => 3,
                'user_id' => 1
            )
        );

        DB::table('sets')->insert(
            array(
                'name' => 'Podstawowy',
                'set' => 'kot;cat' . PHP_EOL . 'pies;dog' . PHP_EOL . 'ptak;bird' . PHP_EOL . 'krowa;cow' . PHP_EOL . 'orzeł;eagle',
                'language1_id' => 1,
                'language2_id' => 2,
                'private' => false,
                'subcategory_id' => 4,
                'user_id' => 1
            )
        );

        DB::table('sets')->insert(
            array(
                'name' => 'Podstawowy',
                'set' => 'góra;mountain' . PHP_EOL . 'dolina;valley' . PHP_EOL . 'skała;rock' . PHP_EOL . 'las;forest' . PHP_EOL . 'wzgórze;hill',
                'language1_id' => 1,
                'language2_id' => 2,
                'private' => false,
                'subcategory_id' => 5,
                'user_id' => 1
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
        Schema::dropIfExists('sets');
    }
}
