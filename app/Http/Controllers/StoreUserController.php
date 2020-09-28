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


        
        // dd($file_name);

        $store = StoreUser::find($id);

        if(!empty($store->image)){
            $image = $store->image;
            $pathdel = public_path().$image;
            // dd($pathdel);
            \File::delete($pathdel);
        }


        $store->name         = request()->store_name;
        $store->address      = request()->address;
        $store->introduction = request()->introduction;
        $store->category     = request()->category;
        if(request()->file){
            $file_name = request()->file->getClientOriginalName();
            request()->file->storeAs('public/Store/',$file_name);

            $store->image        = '/storage/Store/'.$file_name; 
        }
        $store->save();

        // if($store){
        //     return $this->refresh();
        // }
    }

    public function newStoreGet(){
        $stores = StoreUser::orderBy('id','DESC')->take(3)->get();

        return $stores;
    }

    public function storeImage($id){
        
    }
}
