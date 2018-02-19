<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalities', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->datetime('deleted_at')->nullable();
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->integer('mbti_id')->unsigned();
          $table->foreign('mbti_id')->references('id')->on('mbtis');
          $table->integer('best_performance_id')->unsigned();
          $table->foreign('best_performance_id')->references('id')->on('best_performances');
          $table->text('strength')->nullable();
          $table->text('weakness')->nullable();
          $table->text('role_model')->nullable();
          $table->text('problem_solver')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personalities');
    }
}
