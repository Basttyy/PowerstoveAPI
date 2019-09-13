<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoves', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('imei', 50)->unique();
            $table->integer('user_id')->nullable()->unsigned()->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->tinyInteger('paid')->default(0);
            $table->string('api_token', 40);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stoves');
    }
}
