<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($table)
		{
			$table->bigIncrements('id');
			$table->date('when');
			$table->string('name');
			$table->bigInteger('category_id');
			$table->bigInteger('venue_id');
			$table->bigInteger('organizer_id')->nullable();
			$table->text('description')->nullable();

		    $table->primary('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
