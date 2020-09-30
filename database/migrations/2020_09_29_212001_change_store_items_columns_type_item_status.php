<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStoreItemsColumnsTypeItemStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_items', function (Blueprint $table) {
            //
            $table->string('item_status')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_items', function (Blueprint $table) {
            //
            $table->char('item_status',1)->change();
        });
    }
}
