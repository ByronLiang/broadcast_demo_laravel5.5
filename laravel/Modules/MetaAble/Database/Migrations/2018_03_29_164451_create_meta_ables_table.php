<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaAblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('meta_ables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->index();
            $table->longtext('value');

            $table->string('able_type');
            $table->unsignedInteger('able_id');
            $table->index(['able_type', 'able_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_ables');
    }
}
