<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('admin_id')->unsigned()->references('id')->on('admin')->onUpdate('no action')->onDelete('no action');
            $table->string('name', 128);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->text('credit_card', 512)->nullable();
			$table->string('address', 128)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('region', 50)->nullable();
			$table->string('postal_code', 100)->nullable();
			$table->string('country', 50)->nullable();
            $table->string('mob_phone', 20)->nullable();            
			$table->tinyInteger('activated')->default(0);
            $table->string('avatar', 255);
            $table->rememberToken();
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
        Schema::dropIfExists('agents');
    }
}
