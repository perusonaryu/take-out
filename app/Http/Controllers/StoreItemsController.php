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

    public function StoreItemGet($id){
        $item = StoreItem::where('store_id', $id)->get();
        
        return $item;
        // dd($id);

        // $storeItem = StoreItem::where('store_id', $id)->get();



        // dd($storeItem);

        // $query = StoreItem::query();
        // $item = $query->where('store_id',$id)->get();
        
        // return $item;
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
            //アップロードされた画像の拡張子をとる
            $ext=request()->file->getClientOriginalExtension();
            $file_name = $request->item_name.'.'.$ext;
            
            //storage/app/public/store_item_imagesに保存
            $request->file->storeAs('public/store_item_images', $file_name);
 
            $storeitem = new StoreItem();//店毎でフォルダを作った方が良いか？
            $storeitem->item_name   = $request->item_name;
            $storeitem->price       = $request->price;
            $storeitem->item_status = $request->item_status;
            $storeitem->item_discription = $request->item_discription;
            $storeitem->store_id = $request->store_id;

            if(config('app.env') === 'production'){
                $storeitem->item_image  = 'pickup/storage/store_item_images/' . $file_name;
            }else{
                $storeitem->item_image  = 'storage/store_item_images/' . $file_name;
            }

            $storeitem->save();
 
            StoreItem::create($request->all());
            return ['success' => '登録しました!'];
        }
        //このコード要るのか？
        
        else{
            return $error;
        }
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
        
       $file_path=request()->file;
    //    dd(is_string($file_path));
        if(!is_string($file_path)){
            
                $file_name =request()->item_name.request()->file->getClientOriginalExtension();
                request()->file->storeAs('public/store_item_images',$file_name);

                if(config('app.env') === 'production'){
                    $item_image  = 'pickup/storage/store_item_images/' . $file_name;
                }else{
                    $item_image  = 'storage/store_item_images/' . $file_name;
                }

                $update = [
                    'item_name'  => $request->item_name,
                    'price'      => $request->price,
                    // 'store_id'   => $request->store_id,
                    'item_status'=> $request->item_status,
                    'item_discription'=> $request->item_discription,
                    'item_image' => $item_image,
                ];
                StoreItem::where('id', $id)->update($update);
            }else{
                $update = [
                    'item_name'  => $request->item_name,
                    'price'      => $request->price,
                    // 'store_id'   => $request->store_id,
                    'item_status'=> $request->item_status,
                    'item_image' => $request->file,
                    'item_discription' => $request->item_discription,
                ];
                StoreItem::where('id', $id)->update($update);
            }

            
        // if ($request->file) {
        // $file_name = $request->item_name.'.jpg';
        
        // $request->file('itemimage')->storeAs('public/store_item_images', $file_name)
        // }else{
        //     $file_name = request()->file;
        // }
     
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //画像ファイルの削除
        $deleteStoreItem = StoreItem::find($id);
        $deletename      = $deleteStoreItem->item_image;
        $pathdel         = public_path().'/'.$deletename;
        // dd($pathdel);
        \File::delete($pathdel);
        $deleteStoreItem->delete();
        
        // StoreItem::where('id', $id)->delete();
    }

}