<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoveLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stove_logs', function (Blueprint $table) {
            $table->string('stove_imei')->primary()->unique();
            $table->unsignedInteger('stove_parameter_id');
            $table->string('value');
            $table->string('logged_at');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();

            $table->foreign('stove_imei')->references('imei')->on('stoves')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('stove_parameter_id')->references('id')->on('stove_parameters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stove_logs');
    }
}
