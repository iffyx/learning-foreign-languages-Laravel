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
            $table->string('login')->unique();
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
                'login' => 'admin',
                'email' => 'admin@admin.com',
                'role_id' => DB::table('roles')->where('name', 'admin')->value('id'),
                'password' => bcrypt('password')
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
