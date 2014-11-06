<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->bigIncrements('id');
			$table->date('created_at');
			$table->date('updated_at');
			$table->string('f_name');
			$table->string('l_name');
			$table->date('b_day');
			$table->char('gender', 1);
			$table->string('email')->unique();
			$table->char('password', 64);
			$table->string('address'); //num and street
			$table->string('city')->nullable(); //could be integer(5) as well
			$table->char('state', 2)->nullable(); //could be integer(5) as well
			$table->char('zip', 5); //could be integer(5) as well
			$table->char('phone', 10)->nullable();
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
