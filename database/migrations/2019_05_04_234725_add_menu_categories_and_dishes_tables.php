<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenuCategoriesAndDishesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->timestamps();
        });

        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('price');
            $table->string('photo');
            $table->unsignedInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('menu_categories')
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
        Schema::dropIfExists('dishes');
        Schema::dropIfExists('menu_categories');
    }
}
