<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaishiAndAnswerColumnFlashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flashes', function (Blueprint $table) {
            //
            $table->string('paishi',20)->comment("Flash牌姿");
            $table->string('answer',5)->comment("Flash答え");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flashes', function (Blueprint $table) {
            //
            $table->dropColumn('paishi');
            $table->dropColumn('answer');
        });
    }
}
