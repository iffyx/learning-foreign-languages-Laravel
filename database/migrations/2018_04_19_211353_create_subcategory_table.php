<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('category_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('subcategories', function($table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        DB::table('subcategories')->insert(
            array(
                'name' => 'Przedmioty szkolne',
                'description' => 'opis pkat 1',
                'category_id' => 1
            )
        );

        DB::table('subcategories')->insert(
            array(
                'name' => 'Przybory szkolne',
                'description' => 'opis pkat 2',
                'category_id' => 1
            )
        );

        DB::table('subcategories')->insert(
            array(
                'name' => 'Choroby',
                'description' => 'opis pkat 3',
                'category_id' => 2
            )
        );

        DB::table('subcategories')->insert(
            array(
                'name' => 'Zwierzęta',
                'description' => 'opis pkat 4',
                'category_id' => 3
            )
        );
        DB::table('subcategories')->insert(
            array(
                'name' => 'Elementy krajobrazu',
                'description' => 'opis pkat 5',
                'category_id' => 3
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
        Schema::dropIfExists('subcategories');
    }
}
