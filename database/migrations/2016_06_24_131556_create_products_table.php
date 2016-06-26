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
        Schema::create('filters', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->primary('id');
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('filter_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('filter_id')
                ->references('id')
                ->on('filters')
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
        Schema::drop('tags');
        Schema::drop('filters');
        Schema::drop('products');
    }
}
