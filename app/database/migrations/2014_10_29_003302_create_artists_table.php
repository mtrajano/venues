<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('artists', function($table)
		{
			$table->date('created_at');
			$table->date('updated_at');
			$table->bigIncrements('id');
			$table->string('name');
			$table->bigInteger('genre_id');
			$table->bigInteger('artistlink_id');
			$table->bigInteger('jambase_id')->nullable()->default(0);
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
		Schema::drop('artists');
	}

}
