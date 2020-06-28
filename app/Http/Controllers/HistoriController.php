<?php

namespace App\Http\Controllers;

use App\Histori;
use Illuminate\Http\Request;

class HistoriController extends Controller
{
    public function index()
    {
    	$histori = auth()->user()->transaksi()->histori;

    	$data=['histori'=>$histori];
    	return $data;
    }

    public function getHistoriByTransaksi(Request $id_transaksi){
       
        $Histori = Histori::select('id_histori','id_transaksi')
                ->join('transaksi','transaksi.id_transaksi','=','histori.id_transaksi')
                ->where(['id_transaksi' => input::all()])
                ->get();
        // SELECT * FROM `store` JOIN 'service' ON store.service_id = service.id_service WHERE store.service_id = 1;
        if(!$store){
            return response()->json([
                'success' => false,
                'message' => 'store with id ' . $service_id . ' not found'
            ], 400);
        }

        return response()->json([
            // 'success' => true,
            'data' => $store->toArray()
        ], 200);
    }

    public function show($id_histori)
    {
    	$histori = Histori::find($id_histori);
    	
    	if(!$histori){
    		return response()->json([
    			'success' => false,
    			'message' => 'histori with id ' . $id_histori . ' not found'
    		], 400);
    	}

    	return response()->json([
    		'success' => true,
    		'data' => $histori->toArray()
    	], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_transaksi' => 'required',
        ]);
    }

    public function create(Request $request)
    {
        $histori = new Histori();
        $histori->id_transaksi = $request->id_transaksi;

        $histori->save();

        return response()->json([
                'success' => true,
                'data' => $histori->toArray()
            ]);
    }

    public function update(Request $request, $id_histori)
    {
        $histori = Histori::find($id_histori);

        $histori->id_transaksi = $request->id_transaksi;
 
        if (!$histori) {
            return response()->json([
                'success' => false,
                'message' => 'histori with id ' . $id_histori . ' not found'
            ], 400);
        }
 
        $updated = $histori->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'histori could not be updated'
            ], 500);
    }

    public function destroy($id_histori)
    {
        $histori = Histori::find($id_histori);
 
        if (!$histori) {
            return response()->json([
                'success' => false,
                'message' => 'histori with id ' . $id_histori . ' not found'
            ], 400);
        }
 
        if ($histori->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'histori could not be deleted'
            ], 500);
        }
    }
}
