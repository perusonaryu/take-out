<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    //$fillableホワイトリストcreate,fill,updateが可能になる
    protected $fillable = [
        'item_name',
        'price',
        'store_id',
        'item_status',//店側で売り切れにする機能が要る
        'item_image',
        'item_discription',
    ];
}
