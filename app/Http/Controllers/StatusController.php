<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
	 public function index()
    {
    	$status = Status::all();

    	$data=$status;
    	return $data;
    }

    public function show($id_status)
    {
    	$status = Status::find($id_status);
    	
    	if(!$status){
    		return response()->json([
    			'success' => false,
    			'message' => 'status with id ' . $id_status . ' not found'
    		], 400);
    	}

    	return response()->json([
    		'success' => true,
    		'data' => $status->toArray()
    	], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_status' => 'required',
            'nama_status' => 'required',
        ]);
    }

    public function create(Request $request)
    {
        $status = new Status();
        $status->id_status = $request->id_status;
        $status->nama_status = $request->nama_status;

        $status->save();

        return response()->json([
                'success' => true,
                'data' => $status->toArray()
            ]);
    }

    public function update(Request $request, $id_status)
    {
        $status = Status::find($id_status);

        $status->id_status = $request->id_status;
        $status->nama_status = $request->nama_status;
 
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'status with id ' . $id_status . ' not found'
            ], 400);
        }
 
        $updated = $status->fill($request->all())->save();
 
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

    public function destroy($id_status)
    {
        $status = Status::find($id_status);
 
        if (!$status) {
            return response()->json([
                'success' => false,
                'message' => 'status with id ' . $id_status . ' not found'
            ], 400);
        }
 
        if ($status->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'status could not be deleted'
            ], 500);
        }
    }
}