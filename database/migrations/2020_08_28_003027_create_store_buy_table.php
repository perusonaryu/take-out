<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_buy', function (Blueprint $table) {
            $table->id();
            $table->string('item_amount');
            $table->string('item_total_price');
            $table->char('buy_status',1);
            $table->string('pickup_date_time');
            $table->char('pickup_status',1);
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
        Schema::dropIfExists('store_buy');
    }
}
