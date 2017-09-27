<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_company',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('contact_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('active')->default(0);
            $table->string('type')->default(1);
            $table->string('op')->nullable();
            $table->string('type_pay')->default(1);
            $table->string('site')->nullable();
            $table->string('social_page')->nullable();
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
        Schema::dropIfExists('wt_company');
    }
}
