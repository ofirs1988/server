<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wt_users', function (Blueprint $table) {
            $table->string('fid')->nullable();
            $table->string('gid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wt_users', function (Blueprint $table) {
            $table->dropColumn('fid');
            $table->dropColumn('gid');
        });
    }
}
