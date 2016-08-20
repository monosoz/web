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
            $table->integer('child_id')->unsigned()->nullable();
            $table->integer('item_no');
            $table->timestamps();
            $table->foreign('parent_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
            $table->foreign('child_id')
                ->references('id')
                ->on('addons')
                ->onDelete('cascade');
            $table->unique(['parent_id', 'child_id', 'item_no']);
        });
        Schema::create('guest_item_relations', function (Blueprint $table) {
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->integer('child_id')->unsigned()->nullable();
            $table->integer('item_no');
            $table->timestamps();
            $table->foreign('parent_id')
                ->references('id')
                ->on('guestitems')
                ->onDelete('cascade');
            $table->foreign('child_id')
                ->references('id')
                ->on('addons')
                ->onDelete('cascade');
            $table->unique(['parent_id', 'child_id', 'item_no']);
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
        Schema::drop('guest_item_relations');
    }
}
