<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnOnPasswordResetsTable extends Migration
{

    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
    }


    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable();

        });
    }
}
