<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_file', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->string('sample_id')->comment('获取试听数据的查询ID');
            $table->string('sample_key')->nullable()->comment('试听文件的key');
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
        Schema::dropIfExists('sample_file');
    }
}
