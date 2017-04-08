<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatalogsTable extends Migration
{
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
            $table->timestamps();
            $table->string('user_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('description', 65535)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('slug', 255)->nullable()->unique();
            $table->string('meta_keywords', 65535)->nullable();
            $table->string('status', 9)->nullable();
            $table->string('featured')->nullable();
            $table->string('recurring', 13)->nullable();
            $table->string('recurring_date')->nullable();
            $table->string('due_by')->nullable();
            $table->string('longitude', 25)->nullable();
            $table->string('latitude', 25)->nullable();
            $table->string('address1', 125)->nullable();
            $table->string('address2', 125)->nullable();
            $table->string('city', 125)->nullable();
            $table->string('state', 125)->nullable();
            $table->string('country', 225)->nullable();
            $table->string('zipcode', 25)->nullable();
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
            $table->string('catalog_type', 9)->nullable();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::drop('catalogs');
    }
}
