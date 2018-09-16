<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoPosterToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->tinyInteger('recommend')->default(1)->comment('是否推荐');
            $table->json('video_poster')->nullable()->comment('视频封面');
            $table->json('video_node')->nullable()->comment('视频节点');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('recommend');
            $table->dropColumn('video_poster');
            $table->dropColumn('video_node');
        });
    }
}
