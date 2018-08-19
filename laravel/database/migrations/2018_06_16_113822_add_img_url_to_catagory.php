<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImgUrlToCatagory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catagory', function (Blueprint $table) {
            $table->string('img_url')->nullable()->comment('分类封面图片');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catagory', function (Blueprint $table) {
            $table->dropColumn('img_url');
        });
    }
}
