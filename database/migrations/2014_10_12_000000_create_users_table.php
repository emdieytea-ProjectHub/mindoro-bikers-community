<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->id();
			$table->string('avatar');
			$table->string('fname');
			$table->string('lname');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamp('last_seen')->nullable();
			$table->string('password');
			$table->string('gender');
			$table->string('phone');
			$table->integer('type');
			$table->rememberToken();
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
		Schema::dropIfExists('users');
	}
}
