<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorChatroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_chatroom', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->string('room_no')->comment('房间号');
            $table->string('listener')->comment('收听用户限制');
            $table->string('pay_rule')->nullable()->comment('付费规则');
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
        Schema::dropIfExists('author_chatroom');
    }
}
