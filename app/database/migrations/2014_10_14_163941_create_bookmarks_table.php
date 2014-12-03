<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookmarks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url', 1000);
			$table->string('shortened_code', 250);
			$table->string('description', 2000)->nullable();
			$table->integer('clicks')->unsigned()->default(0);
			$table->integer('user_id')->unsigned()->nullable();
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
		Schema::drop('bookmarks');
	}

}
