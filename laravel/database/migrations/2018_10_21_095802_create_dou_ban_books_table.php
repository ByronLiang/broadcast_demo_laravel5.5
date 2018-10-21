<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDouBanBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dou_ban_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('subtitle')->default('');
            $table->string('author')->default('');
            $table->string('publisher')->default('');
            $table->string('image')->default('');
            $table->json('tags')->nullable();
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
        Schema::dropIfExists('dou_ban_books');
    }
}
