<?php

namespace App\Http\Controllers;

use App\Kota;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class KotaController extends Controller
{
    public function index()
    {
        $kota = Kota::all();

        $data=$kota;
        return $data;
    }

    public function show($id_kota)
    {
        $kota = Kota::find($id_kota);
        
        if(!$kota){
            return response()->json([
                'success' => false,
                'message' => 'service with id ' . $id_kota . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $kota->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_kota' => 'required',
            'nama_kota' => 'required',
            'img_kota' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    public function create(Request $request)
    {
        $kota = new Kota();
        $kota->id_kota = $request->id_kota;
        $kota->nama_kota = $request->nama_kota;
        if ($request->has('img_kota')) {
            // Get image file
            $image = $request->file('img_kota');
            // Make a image name based on user name and current timestamp
            $name = $request->nama_kota.'_'.time();
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $kota->img_kota = $filePath;
        }

        $kota->save();

        return response()->json([
                'success' => true,
                'data' => $kota->toArray()
            ]);
    }

    public function update(Request $request, $id_kota)
    {
        $kota = Kota::find($id_kota);

        $kota->nama_kota = $request->nama_kota;
        if ($request->has('img_kota')) {
            // Get image file
            $image = $request->file('img_kota');
            // Make a image name based on user name and current timestamp
            $name = $request->name_store.'_'.time();
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $store->img_store = $filePath;
        }

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

    public function destroy($id_kota)
    {
        $kota = Kota::find($id_kota);
 
        if (!$kota) {
            return response()->json([
                'success' => false,
                'message' => 'service with id ' . $id_kota . ' not found'
            ], 400);
        }
 
        if ($kota->delete()) {
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
