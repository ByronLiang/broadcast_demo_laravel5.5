<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('full_name');
            $table->string('pinyin')->nullable();
            $table->unsignedInteger('pid')->nullable();
            $table->string('pids')->nullable();
            $table->boolean('is_edit')->default(0);
            $table->boolean('is_city')->default(false)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });

        Schema::create('district_gables', function (Blueprint $table) {
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->unsignedInteger('district_id')->index();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');

            $table->unsignedInteger('gable_id');
            $table->string('gable_type');
            $table->index(['gable_id', 'gable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_gables');
        Schema::dropIfExists('districts');
    }
}
