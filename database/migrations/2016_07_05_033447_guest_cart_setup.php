<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GuestCartSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing carts
        Schema::create('guestcarts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cart_id')->unsigned();
            $table->timestamps();
            $table->foreign('cart_id')
                ->references('id')
                ->on('cart');
        });
        // Create table for storing items
        Schema::create('guestitems', function (Blueprint $table) {
            $table->bigInteger('guestcart_id')->unsigned()->nullable();
            $table->string('sku');
            $table->decimal('price', 20, 2);
            $table->decimal('tax', 20, 2)->default(0);
            $table->decimal('shipping', 20, 2)->default(0);
            $table->string('currency')->nullable();
            $table->integer('quantity')->unsigned();
            $table->string('class')->nullable();
            $table->string('reference_id')->nullable();
            $table->timestamps();
            $table->foreign('guestcart_id')
                ->references('id')
                ->on('guestcarts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['sku', 'guestcart_id']);
            $table->index(['sku', 'guestcart_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('guestitems');
        Schema::drop('guestcarts');
    }
}