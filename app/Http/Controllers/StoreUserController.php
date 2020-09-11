<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreUser;

class StoreUserController extends Controller
{
    public function update($id)
    {
        $store = StoreUser::find($id);
        $store->name = request('store_name');
        $store->address = request('address');
        $store->introduction = request('introduction');
        $store->category = request('category');
        $store->save();

        // if($store){
        //     return $this->refresh();
        // }
    }
}
