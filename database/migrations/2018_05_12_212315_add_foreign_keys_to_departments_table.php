<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('departments', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'departments_ibfk_1')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('departments', function(Blueprint $table)
		{
			$table->dropForeign('departments_ibfk_1');
		});
	}

}
