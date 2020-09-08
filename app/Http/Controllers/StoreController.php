<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();

        return response()->json($stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Store;
        $store->store_name = $request->storeName;
        $store->address = $request->address;
        $store->introduction = $request->introduction;
        $store->category = $request->category;
        $store->save();
        return response()->json(
            ['message' => 'New post created'],
            ['store' => $store]
        );

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return response() -> json($store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $store = Store::find($id);
        $store->store_name = request('store_name');
        $store->address = request('address');
        $store->introduction = request('introduction');
        $store->category = request('category');
        $store->save();

        if($store){
            return $this->refresh();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        // $stores = Store::orderBy('created_at','DESC');
        // return response()->json($stores);

        if($store->delete()){
            $stores = Store::orderBy('created_at','DESC')->get();
            return response() -> json($stores);
        }else{
            return response()->json(['error' => 'Destroy method has failed.'],425);
        }
    }

    private function refresh(){
        $stores = Store::orderBy('created_at','DESC')->get();
        return response() -> json($stores);
    }
}
