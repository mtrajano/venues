<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attends', function($table)
		{
			$table->date('created_at');
			$table->date('updated_at');
			$table->string('user_id');
			$table->bigInteger('show_id');

		    $table->primary(['user_id', 'show_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attends');
	}

}
