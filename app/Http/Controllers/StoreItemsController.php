<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreItem;
use App\Http\Requests\ValidStoreItem ;

class StoreItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return StoreItem::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidStoreItem $request)
    {
        //item_imageをstorage/app/publicに保存、名前は店ID＋商品名 拡張子はjpgに変えても良いのか？
        // $request->item_image->storeAs('public/store_item_images', $request->store_id.$request->item_name.'.jpg');

        if (request()->file) {
            $file_name = $request->item_name.'.jpg';
            //storage/app/public/store_item_imagesに保存
            request()->file->storeAs('public/store_item_images', $file_name);
 
            $storeitem = new StoreItem();//店毎でフォルダを作った方が良いか？
            $storeitem->item_image  = 'storage/store_item_images/' . $file_name;
            $storeitem->item_name   = $request->item_name;
            $storeitem->price       = $request->price;
            $storeitem->item_status = $request->item_status;
            $storeitem->save();
 
            return ['success' => '登録しました!'];
        }
        //このコード要るのか？
        StoreItem::create($request->all());

        // return ['success' => '登録しました!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidStoreItem $request, $id)
    {
        //
        $update = [
            'item_name'  => $request->item_name,
            'price'      => $request->price,
            // 'store_id'   => $request->store_id,
            'item_status'=> $request->item_status,
            'item_image' => $request->item_image,
        ];
        StoreItem::where('id', $id)->update($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        StoreItem::where('id', $id)->delete();
    }
}
