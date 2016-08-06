<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddressSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('mobile_number');
            $table->string('pincode', 6);
            $table->text('address');
            $table->text('usercomment');
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->text('comment');
            $table->string('update', 8);
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('delivery_address', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned();
            $table->string('name');
            $table->string('mobile_number');
            $table->string('pincode', 6);
            $table->text('address');
            $table->text('usercomment');
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->text('comment');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
        Schema::drop('delivery_address');
    }
}
