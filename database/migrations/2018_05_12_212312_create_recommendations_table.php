<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecommendationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recommendations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->default(0)->index('user_id');
			$table->integer('department_id')->nullable()->default(0);
			$table->string('title');
			$table->string('seo_title')->nullable();
			$table->string('excerpt')->nullable()->default('');
			$table->text('body', 65535);
			$table->string('image')->nullable();
			$table->string('slug')->nullable()->default('')->unique('posts_slug_unique');
			$table->text('meta_description', 65535)->nullable();
			$table->text('meta_keywords', 65535)->nullable();
			$table->enum('status', array('PUBLISHED','DRAFT','PENDING'))->default('DRAFT');
			$table->boolean('featured')->default(0);
			$table->timestamps();
			$table->softDeletes();
			$table->string('upc', 125)->nullable();
			$table->string('amazon_link', 125)->nullable();
			$table->enum('intent', array('WANT','LOVE','HATE'))->default('LOVE');
			$table->integer('catalog_id')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recommendations');
	}

}
