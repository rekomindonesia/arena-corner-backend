<?php

namespace App\Http\Controllers;

use App\Bukti;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use DB;

class BuktiController extends Controller
{
    use UploadTrait;

    public function index()
    {
    	$bukti = DB::select('SELECT * FROM bukti');

    	return view('list_bukti',['bukti'=>$bukti]);
    }

    public function show($id_service)
    {
    	$service = Service::find($id_service);
    	
    	if(!$service){
    		return response()->json([
    			'success' => false,
    			'message' => 'service with id ' . $id_service . ' not found'
    		], 400);
    	}

    	return response()->json([
    		'success' => true,
    		'data' => $service->toArray()
    	], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_bukti' => 'required|integer',
            'id_transaksi' => 'required',
            'tgl_service' => 'required',
            'catatan_service' => 'required',
            'img_tf' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'id_bukti' => 'required|integer',
            'id_transaksi' => 'required',
            'tgl_service' => 'required',
            'catatan_service' => 'required',
            'img_tf' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $bukti = new Bukti();
        $bukti->id_bukti = $request->id_bukti;
        $bukti->id_transaksi = $request->id_transaksi;
        $bukti->tgl_service = $request->tgl_service;
        $bukti->catatan_service = $request->catatan_service;
        if ($request->has('img_tf')) {
            // Get image file
            $image = $request->file('img_tf');
            // Make a image name based on user name and current timestamp
            $name = $request->id_transaksi.'_'.time();
            // Define folder path
            $folder = '/uploads/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $bukti->img_tf = $filePath;
        }

        $bukti->save();

        return response()->json([
                'success' => true,
                'data' => $bukti->toArray()
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
