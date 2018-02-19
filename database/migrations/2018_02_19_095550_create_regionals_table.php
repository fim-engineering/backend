<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regionals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('id_google_calendar')->nullable();
            $table->integer('leader_member_id')->nullable()->unsigned();
            $table->foreign('leader_member_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('deleted_at')->nullable();
            $table->string('user_submit')->nullable();
            $table->string('user_update')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regionals');
    }
}
