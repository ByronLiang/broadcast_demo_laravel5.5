<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_records', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount');
            $table->string('remark');
            $table->string('channel')->comment('支付渠道');
            $table->enum('status', ['paying', 'paid']);
            $table->string('out_trade_no')->nullable()->comment('交易订单号');
            $table->timestamps();

            $table->unsignedInteger('able_id');
            $table->string('able_type');
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
        Schema::dropIfExists('payment_records');
    }
}
