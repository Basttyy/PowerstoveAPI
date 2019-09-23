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
            $table->string('name', 128);
            $table->string('email', 128)->unique();
            $table->string('password', 100);
            $table->integer('agent_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->text('credit_card', 512)->nullable();
			$table->string('address', 128)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('region', 100)->nullable();
			$table->string('postal_code', 100)->nullable();
			$table->string('country', 100)->nullable();
            $table->string('mob_phone', 20)->nullable();            
			$table->tinyInteger('activated')->default(0);
            $table->string('avatar', 255);
            $table->rememberToken();
            $table->dateTime('email_verified_at')->nullable();
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
