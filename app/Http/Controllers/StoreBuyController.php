<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreBuy;
use Auth;

class StoreBuyController extends Controller
{
    //
    public function index()
    {
        return StoreBuy::all();
    }

    public function show($id)
    {   
        $query = StoreBuy::query();
        $query->where('store_id',$id); 
        $query->where('pickup_status',null);
        $storeuser = $query->get();
        // $storeuser = StoreBuy::where('store_id', $id)->get();
        return $storeuser;
    }
    public function deleveried($id)
    {   
        $query = StoreBuy::query();
        $query->where('store_id',$id); 
        $query->where('pickup_status',1);
        $storeuser = $query->get();
        // $storeuser = StoreBuy::where('store_id', $id)->get();
        return $storeuser;
    }
    public function  userboughtitem($id)
    {   
        $query = StoreBuy::query();
        $query->where('user_id',$id); 
        $boughtitem = $query->get();
        // $storeuser = StoreBuy::where('store_id', $id)->get();
        return $boughtitem;
    }
   
    public function store(Request $request)
    {   
        $user = Auth::user();
        // dd($user->id);
        // $iteminfo = serialize($request->item_info);
        // dd($iteminfo,$request->item_info,$request->pickup_date_time);
        // dd($request->item_total_price);
        $store =[
            'item_info'=>$request->item_info,
            'pickup_date_time'=>$request->pickup_date_time,
            'item_total_price'=>$request->item_total_price,
            'store_id' => $request->store_id,
            'user_id'  => $user->id,
        ];
        StoreBuy::create($store);
    }

    public function update(Request $request, $id)
    {
        $update = [
            'pickup_status' => $request->pickup_status,
        ];
        StoreBuy::where('id', $id)->update($update);
    }
}
