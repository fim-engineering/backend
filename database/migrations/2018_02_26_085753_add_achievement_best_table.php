<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAchievementBestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_bests', function (Blueprint $table) {
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

            $table->string('achievement_2')->nullable();
            $table->date('date_form_2')->nullable();
            $table->date('date_end_2')->nullable();
            $table->integer('duration_2')->nullable();
            $table->integer('position_id_2')->unsigned();
            $table->foreign('position_id_2')->references('id')->on('positions');
            $table->string('phone_leader_2')->nullable();
            $table->string('email_leader_2')->nullable();
            $table->text('description_2')->nullable();

            $table->string('achievement_3')->nullable();
            $table->date('date_form_3')->nullable();
            $table->date('date_end_3')->nullable();
            $table->integer('duration_3')->nullable();
            $table->integer('position_id_3')->unsigned();
            $table->foreign('position_id_3')->references('id')->on('positions');
            $table->string('phone_leader_3')->nullable();
            $table->string('email_leader_3')->nullable();
            $table->text('description_3')->nullable();

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
        Schema::dropIfExists('achievement_bests');
    }
}
