<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatasetStoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_stove', function (Blueprint $table) {
            $table->unsignedInteger('dataset_id')->unique()->references('id')->on('datasets')->onUpdate('cascade')->onDelete('cascade');
            $table->string('stove_imei')->unique()->references('imei')->on('stove')->on('datasets')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dataset_stove');
    }
}
