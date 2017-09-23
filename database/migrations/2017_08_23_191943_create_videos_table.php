<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_videos',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('uid');
            $table->unsignedInteger('campaign_id');
            $table->string('src')->nullable();
            $table->string('name')->nullable();
            $table->string('poster')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('type');
            $table->string('theme')->nullable();
            $table->string('totalTime');
            $table->string('clicks')->nullable();
            $table->string('sound')->nullable();
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('wt_users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('wt_company')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('wt_campaign')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wt_videos');
    }
}
