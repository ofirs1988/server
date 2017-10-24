<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_campaign',function (Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->text('body')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedInteger('uid');
            $table->unsignedInteger('cid')->nullable();
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('wt_users')->onDelete('cascade');
            $table->foreign('cid')->references('id')->on('wt_company')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wt_campaign');
    }
}
