<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venues', function($table)
		{
			$table->date('created_at');
			$table->date('updated_at');
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('address')->nullable();
			$table->string('city')->nullable();
			$table->char('state', 2)->nullable();
			$table->char('zip', 5)->nullable(); //could be integer(5) as well
			$table->bigInteger('jambase_id')->nullable();
			$table->char('phone', 10)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('venues');
	}

}
