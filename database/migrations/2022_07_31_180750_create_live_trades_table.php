<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_trades', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('wallet_id');
            $table->string('currency');
            $table->string('symbol');
            $table->float('amount');
            $table->dateTime('in_time');
            $table->float('in_amount');
            $table->string('high_low');
            $table->string('result');
            $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('live_trades');
    }
}
