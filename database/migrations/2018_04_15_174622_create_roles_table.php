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
            $table->string('description');
            $table->timestamps();
        });


        DB::table('roles')->insert(
            array(
                'name' => 'admin',
                'description' => 'Ma dostęp do wszystkich funkcji'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'user',
                'description' => 'Możliwość trybu nauki, testów. Ma dostęp do statystyk.'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'redaktor',
                'description' => 'Może dodawać zestawy do podkategorii, do której ma uprawnienia. Może je też edytować i usuwać.'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'superredaktor',
                'description' => 'Może edytować wszystkie zestawy podkategorii, do których ma uprawnienia.'
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
        Schema::dropIfExists('roles');
    }
}
