<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5pilarInPersonalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personalities', function (Blueprint $table) {
          $table->integer('cintakasih')->nullable();
          $table->integer('integritas')->nullable();
          $table->integer('kebersahajaan')->nullable();
          $table->integer('totalitas')->nullable();
          $table->integer('solidaritas')->nullable();
          $table->integer('keadilan')->nullable();
          $table->integer('keteladanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personalities', function (Blueprint $table) {
            //
        });
    }
}
