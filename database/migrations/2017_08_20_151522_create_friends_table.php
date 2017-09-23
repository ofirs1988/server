<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_friends', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->integer('fid');
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('wt_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wt_friends');
    }
}
