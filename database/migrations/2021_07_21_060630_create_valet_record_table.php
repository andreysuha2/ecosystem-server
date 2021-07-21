<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValetRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valet_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valet_id');
            $table->unsignedBigInteger('category_id');
            $table->bigInteger('author_id');
            $table->bigInteger('currency_id');
            $table->text('description')->nullable();
            $table->decimal('value', 11, 2);
            $table->enum('type', [ 'income', 'consumption' ]);
            $table->dateTime('date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('valet_id')->references('id')->on('valets')->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('valet_category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valet_record');
    }
}
