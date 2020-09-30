<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreBuy;

class StoreBuyController extends Controller
{
    //
    public function index()
    {
        return StoreBuy::all();
    }

    public function store(Request $request)
    {   
        $iteminfo = serialize($request->item_info);
        // dd($iteminfo,$request->item_info,$request->pickup_date_time);
        // dd($request->item_total_price);
        $store =[
            'item_info'=>$iteminfo,
            'pickup_date_time'=>$request->pickup_date_time,
            'item_total_price'=>$request->item_total_price,
        ];
        StoreBuy::create($store);
    }

    public function update(Request $request, $id)
    {
        $update = [
             
            
            'item_info' => $request->item_info,
            'item_total_price' => $request->item_total_price,
            'buy_status' => $request->buy_status,
            'pickup_date_time' => $request->pickup_date_time,
            'pickup_status' => $request->pickup_status,
            'store_id' => $request->store_id,
            'user_id' => $request->user_id,
        ];
        StoreBuy::where('id', $id)->update($update);
    }
}
