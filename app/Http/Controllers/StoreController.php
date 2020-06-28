<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    // $id_store = Store::where('service_id', $email)->first(['id']);

    public function index()
    {
    	$store = Store::all();

    	$data=$store;
    	return $data;
    }

    public function getStoreByKategori(Request $kategori_id){
       
        $store = Store::select('id_store','kategori_id','name_store','no_telp','alamat', 'harga','img_store')
                ->join('kategori','kategori.id_kategori','=','store.kategori_id')
                ->where(['kategori_id' => $kategori_id->input('kategori_id')])
                ->get();
        // SELECT * FROM `store` JOIN 'service' ON store.service_id = service.id_service WHERE store.service_id = 1;
        if(!$store){
            return response()->json([
                'success' => false,
                'message' => 'store with id ' . $kategori_id . ' not found'
            ], 400);
        }

        return response()->json([
            // 'success' => true,
            'data' => $store->toArray()
        ], 200);
    }

    public function show(Request $id_store)
    {
    	
    	if(!$store){
    		return response()->json([
    			'success' => false,
    			'message' => 'store with id ' . $id_store . ' not found'
    		], 400);
    	}

    	return response()->json([
    		'success' => true,
    		'data' => $store->toArray()
    	], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        	'service_id' => 'required',
            'name_store' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'img_store' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    public function create(Request $request)
    {
        $store = new Store();
        $store->service_id = $request->service_id;
        $store->name_store = $request->name_store;
        $store->no_telp = $request->no_telp;
        $store->alamat = $request->alamat;

        $store->save();

        return response()->json([
                'success' => true,
                'data' => $store->toArray()
            ]);
    }

    public function update(Request $request, $id_store)
    {
        $store = Store::find($id_store);
		$store->service_id = $request->service_id;
        $store->name_store = $request->name_store;
        $store->no_telp = $request->no_telp;
        $store->alamat = $request->alamat;
 
        if (!$store) {
            return response()->json([
                'success' => false,
                'message' => 'store with id ' . $id_store . ' not found'
            ], 400);
        }
 
        $updated = $store->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'store could not be updated'
            ], 500);
    }

    public function destroy($id_store)
    {
        $store = Store::find($id_store);
 
        if (!$store) {
            return response()->json([
                'success' => false,
                'message' => 'store with id ' . $id_store . ' not found'
            ], 400);
        }
 
        if ($service->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'store could not be deleted'
            ], 500);
        }
    }
}
