<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add3ProblemInPersonalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personalities', function (Blueprint $table) {
          $table->text('role_model')->nullable()->after('best_performance')->change();
          $table->text('role_model_2')->nullable();
          $table->text('role_model_3')->nullable();
          $table->text('problem_solver')->nullable()->after('role_model')->change();
          $table->text('problem_solver_2')->nullable();
          $table->text('problem_solver_3')->nullable();

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
