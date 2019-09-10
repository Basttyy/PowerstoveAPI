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
            $table->string('imei', 50)->primary();
            $table->string('name', 60)->nullable();
            $table->integer('user_id')->unsigned()->references('id')->on('users');
            $table->tinyInteger('paid')->default(0);
            $table->string('api_token', 60)->nullable()->unique();
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
