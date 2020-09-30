<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreBuy extends Model
{
    //
    protected $fillable = [
        'item_info',
        'item_total_price',
        'buy_status',
        'pickup_date_time',
        'pickup_status',
        'store_id',
        'user_id',
    ];

    protected $table = 'store_buy';

}
