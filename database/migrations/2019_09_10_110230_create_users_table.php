<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->text('credit_card', 65535)->nullable();
			$table->string('address_1', 100)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('region', 100)->nullable();
			$table->string('postal_code', 100)->nullable();
			$table->string('country', 100)->nullable();
            $table->string('mob_phone', 100)->nullable();            
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
        Schema::dropIfExists('users');
    }
}
