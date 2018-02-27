<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDateFormTofrom2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievement_bests', function (Blueprint $table) {
          $table->renameColumn('date_form_2', 'date_from_2');
          $table->renameColumn('date_form_3', 'date_from_3');

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
