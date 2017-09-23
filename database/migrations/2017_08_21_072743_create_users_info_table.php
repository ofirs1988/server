<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_usersinfo', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('wt_users');
            $table->string('birthday')->nullable();
            $table->integer('age')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('hometown')->nullable();
            $table->string('education')->nullable();
            $table->string('gender')->nullable();
            $table->string('website')->nullable();
            $table->string('work')->nullable();
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
        Schema::dropIfExists('wt_usersInfo');
    }
}
