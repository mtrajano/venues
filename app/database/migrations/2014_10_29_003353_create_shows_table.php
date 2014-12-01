<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shows', function($table)
		{
			$table->date('created_at');
			$table->date('updated_at');
			$table->bigIncrements('id');
			$table->date('when');
			$table->bigInteger('artist_id');
			$table->bigInteger('venue_id');
			$table->text('description')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shows');
	}

}
