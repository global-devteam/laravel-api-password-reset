<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropTimestamps();
        });
    }
}
