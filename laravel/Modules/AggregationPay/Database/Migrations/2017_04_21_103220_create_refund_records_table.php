<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_records', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount');
            $table->string('remark');
            $table->enum('status', ['refunding', 'refunded', 'failure']);
            $table->string('refund_no');
            $table->string('failure_reason')->commit('失败原因');
            $table->timestamps();

            $table->unsignedInteger('able_id');
            $table->string('able_type');
            $table->index(['able_id', 'able_type']);

            $table->unsignedInteger('payment_record_id');
            $table->foreign('payment_record_id')->references('id')->on('payment_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refund_records');
    }
}
