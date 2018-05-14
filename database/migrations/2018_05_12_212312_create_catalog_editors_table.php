<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatalogEditorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('catalog_editors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->default(0)->index('user_id');
			$table->integer('catalog_id')->index('list_id');
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
		Schema::drop('catalog_editors');
	}

}
