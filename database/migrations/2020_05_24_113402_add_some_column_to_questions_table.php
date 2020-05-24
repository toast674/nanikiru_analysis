<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            //          
            $table->integer('junnme')->comment("巡目");
            $table->string('kyoku', 10)->comment("局");
            $table->string('tya', 4)->comment("家");
            $table->string('description', 400)->comment("解答解説");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
            $table->dropColumn('junnme');
            $table->dropColumn('kyoku');
            $table->dropColumn('tya');
            $table->dropColumn('description');
        });
    }
}
