<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoe_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shoe_id')->references('id')->on('shoes');
            $table->string('color');
            $table->integer('size');
            $table->integer('stock');
            $table->float('weight');
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoe_details');
    }
}
