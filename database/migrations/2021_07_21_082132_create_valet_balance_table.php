<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValetBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valet_balance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valet_id');
            $table->bigInteger('currency_id');
            $table->bigInteger('author_id');
            $table->decimal('value', 11, 2);
            $table->dateTime('date');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('valet_balance');
    }
}
