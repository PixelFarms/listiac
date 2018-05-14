<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatalogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('catalogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->default(0);
			$table->string('title');
			$table->text('description', 65535)->nullable();
			$table->string('image')->nullable();
			$table->string('slug')->nullable()->default('')->unique('posts_slug_unique');
			$table->text('meta_keywords', 65535)->nullable();
			$table->enum('status', array('PUBLISHED','DRAFT','PENDING'))->default('DRAFT');
			$table->boolean('featured')->default(0);
			$table->enum('recurring', array('Weekly','Daily','Monthly','Yearly','Other','Not Recurring'))->nullable()->default('Not Recurring');
			$table->dateTime('recurring_date')->nullable();
			$table->dateTime('due_by')->nullable();
			$table->string('longitude', 25)->nullable();
			$table->string('latitude', 25)->nullable();
			$table->string('address1', 125)->nullable();
			$table->string('address2', 125)->nullable();
			$table->string('city', 125)->nullable();
			$table->string('state', 125)->nullable();
			$table->string('country', 225)->nullable();
			$table->string('zipcode', 25)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->enum('catalog_type', array('Purchase','Recommend','Avoid'))->default('Recommend');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('catalogs');
	}

}
