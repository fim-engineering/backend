<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIntegerToFloatAchievementbest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievement_bests', function (Blueprint $table) {
          $table->float('duration',10,10)->nullable()->change();
          $table->float('duration_2',10,10)->nullable()->change();
          $table->float('duration_3',10,10)->nullable()->change();

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
