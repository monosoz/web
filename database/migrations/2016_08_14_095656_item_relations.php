<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('item_relations', function (Blueprint $table) {
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('child_id')->unsigned()->nullable();
            $table->integer('item_no');
            $table->foreign('parent_id')
                ->references('id')
                ->on('items');
            $table->foreign('child_id')
                ->references('id')
                ->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('item_relations');
    }
}
