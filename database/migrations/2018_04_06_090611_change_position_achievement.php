<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePositionAchievement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievement_bests', function (Blueprint $table) {
          $table->string('position_name')->nullable()->after('achievement')->change();
          $table->string('position_name_2')->nullable()->after('achievement_2')->change();
          $table->string('position_name_3')->nullable()->after('achievement_3')->change();
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
