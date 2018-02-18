<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id')->references('id')->on('users');
            $table->string('full_name',255)->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('lat',255)->nullable();
            $table->string('lng',255)->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo_profile_link')->nullable();
            $table->string('ktp_link',255)->nullable();
            $table->string('blood',20)->nullable();
            $table->date('born_date')->nullable();
            $table->string('born_city')->nullable();
            $table->string('born_lat',255)->nullable();
            $table->string('born_lng',255)->nullable();
            $table->integer('marriage_status')->nullable();
            $table->string('address_format',255)->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('instagram',100)->nullable();
            $table->string('blog',100)->nullable();
            $table->string('line',100)->nullable();
            $table->text('disease_history')->nullable();
            $table->string('video_profile')->nullable();
            $table->string('religion',20)->nullable();
            $table->integer('is_ready',10)->default(0);
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
