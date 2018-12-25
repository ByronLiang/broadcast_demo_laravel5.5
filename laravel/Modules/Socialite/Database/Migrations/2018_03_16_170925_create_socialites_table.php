<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('socialites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider')->comment('登录类型');
            $table->string('unique_id')->comment('凭证ID');
            $table->json('extend')->nullable()->comment('扩展数据|字段');
            $table->string('avatar');
            $table->string('nickname');
            $table->timestamps();

            $table->unique(['provider', 'unique_id']);

            $table->unsignedInteger('able_id')->nullable();
            $table->string('able_type')->nullable();
            $table->index(['able_id', 'able_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialites');
    }
}
