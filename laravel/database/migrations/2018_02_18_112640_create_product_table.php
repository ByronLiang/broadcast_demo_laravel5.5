<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('price')->default(0);
            $table->timestamp('online_date')->nullable();
            $table->unsignedTinyInteger('type');
            $table->string('url')->nullable();
        });

        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id');
            $table->json('picture')->nullable();
            $table->string('url')->nullable();
            $table->string('resource')->nullable()->comment('跳转参数');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('size')->nullable();
            $table->unsignedTinyInteger('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
        Schema::dropIfExists('banner');
    }
}
