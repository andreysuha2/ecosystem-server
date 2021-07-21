<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValetCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valet_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valet_id');
            $table->bigInteger('author_id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('valet_category');
    }
}
