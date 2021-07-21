<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserValetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_valet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valet_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('role', [ 'admin', 'user', 'moderator' ])->default('user');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('valet_id')->references('id')->on('valets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_valet');
    }
}
