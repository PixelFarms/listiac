<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecommendationsTable extends Migration
{
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
            $table->timestamps();
            $table->string('user_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->string('excerpt', 65535)->nullable();
            $table->string('body', 65535)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('slug', 255)->nullable()->unique();
            $table->string('meta_description', 65535)->nullable();
            $table->string('meta_keywords', 65535)->nullable();
            $table->string('status', 9)->nullable();
            $table->string('featured')->nullable();
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('upc', 125)->nullable();
            $table->string('amazon_link', 125)->nullable();
            $table->string('intent', 4)->nullable();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
