<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->integer('role_id')->unsigned()->nullable();
//            $table->string('role');
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();
        });

        /*Schema::table('users', function($table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });*/

        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'surname' => 'admin',
                'email' => 'admin@admin.com',
                'role_id' => DB::table('roles')->where('name', 'admin')->value('id'),
                'password' => bcrypt('password')
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'editor',
                'surname' => 'editor',
                'email' => 'editor@editor.com',
                'role_id' => DB::table('roles')->where('name', 'redaktor')->value('id'),
                'password' => bcrypt('editor')
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'supereditor',
                'surname' => 'supereditor',
                'email' => 'supereditor@editor.com',
                'role_id' => DB::table('roles')->where('name', 'superredaktor')->value('id'),
                'password' => bcrypt('supereditor')
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'user',
                'surname' => 'user',
                'email' => 'user@user.com',
                'role_id' => DB::table('roles')->where('name', 'user')->value('id'),
                'password' => bcrypt('user')
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
        Schema::dropIfExists('users');
    }
}
