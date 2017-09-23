<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('wt_role', function (Blueprint $table) {
//            $table->integer('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('wt_users');
//            $table->increments('role_id');
//            $table->timestamps();
//        });
//    }

    public function up()
    {
        Schema::create('wt_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('permissions')->nullable();
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
        Schema::drop('wt_roles');
    }
}