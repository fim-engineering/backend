<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAchievementBestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievement_bests', function (Blueprint $table) {
          $table->text('achievement')->nullable()->change();
          $table->text('achievement_2')->nullable()->change();
          $table->text('achievement_3')->nullable()->change();

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
