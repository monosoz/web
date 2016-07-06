<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->binary('image');
            $table->timestamps();
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->primary('id');
        });
        Schema::create('product_tag', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });

            
        Schema::create('variants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->decimal('price', 20, 2);
            $table->string('name');
            $table->integer('product_id')->unsigned();
            $table->timestamps();
            $table->index('sku');
            $table->index('price');            
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('variants');
        Schema::drop('product_tag');
        Schema::drop('tags');
        Schema::drop('products');
    }
}