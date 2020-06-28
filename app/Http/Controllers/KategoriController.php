<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
    	$kategori = Kategori::all();

    	$data=$kategori;
    	return $data;
    }

    public function show($id_kategori)
    {
    	$kategori = Kategori::find($id_kategori);
    	
    	if(!$kategori){
    		return response()->json([
    			'success' => false,
    			'message' => 'service with id ' . $id_kategori . ' not found'
    		], 400);
    	}

    	return response()->json([
    		'success' => true,
    		'data' => $kategori->toArray()
    	], 400);
    }

    public function getKategoriByKota(Request $kota_id){
       
        $kategori = Kategori::select('id_kategori', 'kota_id', 'kategori_name')
                ->join('kota','kota.id_kota','=','kategori.kota_id')
                ->where(['kota_id' => $kota_id->input('kota_id')])
                ->get();
        // SELECT * FROM `store` JOIN 'service' ON store.service_id = service.id_service WHERE store.service_id = 1;
        if(!$kategori){
            return response()->json([
                'success' => false,
                'message' => 'store with id ' . $kota_id . ' not found'
            ], 400);
        }

        return response()->json(
            // 'success' => true,
            $kategori
        , 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_service' => 'required',
            'service_name' => 'required',
        ]);
    }

    public function create(Request $request)
    {
        $service = new Service();
        $service->id_service = $request->id_service;
        $service->service_name = $request->service_name;

        $service->save();

        return response()->json([
                'success' => true,
                'data' => $service->toArray()
            ]);
    }

    public function update(Request $request, $id_service)
    {
        $service = Service::find($id_service);

        $service->id_service = $request->id_service;
        $service->service_name = $request->service_name;
 
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'service with id ' . $id_service . ' not found'
            ], 400);
        }
 
        $updated = $service->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'service could not be updated'
            ], 500);
    }

    public function destroy($id_service)
    {
        $service = Service::find($id_service);
 
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'service with id ' . $id_service . ' not found'
            ], 400);
        }
 
        if ($service->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'service could not be deleted'
            ], 500);
        }
    }
}
