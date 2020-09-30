<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStoreBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_buy', function (Blueprint $table) {
            //
            $table->string('store_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('buy_status')->nullable()->change();
            $table->renameColumn('item_amount', 'item_info')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_buy', function (Blueprint $table) {
            //
            $table->dropColumn('store_id')->nullable();
            $table->dropColumn('user_id')->nullable();
            $table->string('buy_status')->change();
            $table->renameColumn('item_info', 'item_amount')->change();
        });
    }
}
