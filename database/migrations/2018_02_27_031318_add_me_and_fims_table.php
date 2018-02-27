<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMeAndFimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('me_and_fims', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('fim_reference')->nullable();
            $table->integer('fim_reference_id')->unsigned()->nullable();
            $table->text('why_join_fim')->nullable();
            $table->text('skill_for_fim')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->text('performance_apiekspresi')->nullable();
            $table->integer('is_ready')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('me_and_fims');
    }
}
