<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->datetime('deleted_at')->nullable();
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->string('achievement')->nullable();
          $table->date('date_form')->nullable();
          $table->date('date_end')->nullable();
          $table->integer('duration')->nullable();
          $table->integer('position_id')->unsigned();
          $table->foreign('position_id')->references('id')->on('positions');
          $table->string('phone_leader')->nullable();
          $table->string('email_leader')->nullable();
          $table->text('description')->nullable();
          $table->string('is_ready')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
