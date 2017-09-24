<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_role_users',function (Blueprint $table){
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->unique(['user_id','role_id']);
            $table->foreign('user_id')->references('id')->on('wt_users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('wt_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wt_role_users');
    }
}
