<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAchievementbestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievement_bests', function (Blueprint $table) {
          $table->string('position')->nullable();
          $table->string('position_2')->nullable();
          $table->string('position_3')->nullable();
          $table->integer('position_id')->unsigned()->nullable()->change();
          $table->integer('position_id_2')->unsigned()->nullable()->change();
          $table->integer('position_id_3')->unsigned()->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('achievement_bests', function (Blueprint $table) {
            //
        });
    }
}
