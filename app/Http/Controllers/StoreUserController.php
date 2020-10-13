<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreUser;
use Illuminate\Support\Facades\Storage;

class StoreUserController extends Controller
{
    public function update($id)
    {
        // dd(request()->store_name);

        // dd(config('app.env'));

        
        // dd($file_name);

        $store = StoreUser::find($id);

        if (!empty($store->image)) {
            $image = $store->image;
            $pathdel = public_path().$image;
            // dd($pathdel);
            \File::delete($pathdel);
        }


        $store->name         = request()->store_name;
        $store->address      = request()->address;
        $store->introduction = request()->introduction;
        $store->category     = request()->category;
        if (request()->file) {
            $file_name = request()->file->getClientOriginalName();
            request()->file->storeAs('public/Store/', $file_name);
            if(config('app.env') === 'local'){
                $store->image        = '/storage/Store/'.$file_name;
            }else if(config('app.env') === 'production'){
                $store->image        = 'pickup/storage/Store/'.$file_name;
            }
        }
        $store->save();

        // if($store){
        //     return $this->refresh();
        // }
    }

    public function newStoreGet()
    {
        $stores = StoreUser::orderBy('id', 'DESC')->take(3)->get();

        return $stores;
    }

    public function storeImage($id)
    {
        $storeInfo = StoreUser::where('id', $id)->get();
        // dd($storeInfo);
        return $storeInfo;
    }

    public function shopListGet($id)
    {
        // dd($id);
        if ($id==="0") {
            $shoplist = StoreUser::where('category', '和食')->get();
            return $shoplist;
        } elseif ($id==="1") {
            $shoplist = StoreUser::where('category', '洋食')->get();
            return $shoplist;
        } elseif ($id==="2") {
            $shoplist = StoreUser::where('category', '中華')->get();
            return $shoplist;
        } else {
            return ["erorr"=>"失敗しました"];
        }
    }

    public function StoreAdressSerch(Request $request){
        // dd($request->all());
        $shop = StoreUser::where('address','like','%'.$request->address.'%')->orderBy('id','desc')->get();

        return $shop;
    }

    public function storeGet($id)
    {
        $stores = StoreUser::find($id);

        return $stores;
    }
}
