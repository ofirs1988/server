<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('message', 110);
            $table->smallInteger('read')->default(1);
            $table->integer('user_id');
            $table->integer('from_uid');
            $table->timestamps('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wt_messages');
    }
}
