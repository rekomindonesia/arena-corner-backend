<?php
 
namespace App\Http\Controllers;
 
use App\Transaksi;
use Illuminate\Support\Facades\Auth;
// use App\Http\Transaksi;
use App\Status;
use DB;
use Illuminate\Http\Request;
 
class TransaksiController extends Controller
{
    public function index(Request $request)
    {
 
        // $id_status = $request->id_status;
        
        // dd($id_status);
        // $transaksi = Transaksi::all()->toArray();

        $transaksi = DB::select('SELECT transaksi.id_transaksi, users.name as name, store.name_store, transaksi.tgl_service, transaksi.catatan_service, status.nama_status FROM transaksi JOIN users on users.id=transaksi.user_id join store on store.id_store=transaksi.id_store JOIN status ON status.id_status=transaksi.id_status ORDER BY tgl_service ASC');

        return view('list_transaksi',['transaksi'=>$transaksi]);
        // return view('list_transaksi', compact('transaksi'));

    }

    public function getDataByTransaksi(){
        $transaksi = Transaksi::with(['store','status','user'])->where('user_id', Auth::user()->id)->orderBy('id_transaksi', 'ASC')->get();
        // $fix_transaksi = auth()->user()->transaksi;
    return response()->json(['data' => $transaksi]);

    }

    public function getStoreById(){
        $transaksi = Transaksi::all();
    return response()->json($transaksi);
    }

    public function show($id_transaksi)
    {
        $transaksi = auth()->user()->transaksi()->find($id_transaksi);
 
        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi with id ' . $id_transaksi . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $transaksi->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_store' => 'required',
            'waktu_service' => 'required',
            'tgl_service' => 'required',
            'catatan_service' =>'required',
            'id_status' => 'required'
        ]);
 
        $transaksi = new Transaksi();
        $transaksi->id_store = $request->id_store;
        $transaksi->waktu_service = $request->waktu_service;
        $transaksi->tgl_service = $request->tgl_service;
        $transaksi->catatan_service = $request->catatan_service;
        $transaksi->id_status = $request->id_status;
 
        if (auth()->user()->transaksi()->save($transaksi))
            return response()->json([
                'success' => true,
                'data' => $transaksi->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Transaksi could not be added'
            ], 500);
    }

    public function edit($id_transaksi)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $transaksi = DB::table('transaksi')->where('id_transaksi',$id_transaksi)->get();

        // passing data pegawai yang didapat ke view edit.blade.php
        return view('edit', ['transaksi' => $transaksi]);
     
    }
 
    // public function update(Request $request, $id_transaksi)
    // {
    //     // $transaksi = DB::table('transaksi')->where('id_transaksi', $request->id_transaksi);
    //     $transaksi = auth()->user()->transaksi()->find($id_transaksi);
 
    //     if (!$transaksi) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Transaksi with id ' . $id_transaksi . ' not found'
    //         ], 400);
    //     }
 
    //     $updated = $transaksi->fill($request->all())->save();
 
    //     if ($updated)
    //         // return redirect('/list_transaksi'); 
    //            return response()->json([
    //             'success' => true
    //         ]);
    //     else
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Transaksi could not be updated'
    //         ], 500);
    // }

    public function update(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $transaksi->id_status = $request->id_status;
        $transaksi->save();
        // DB::table('transaksi')->where('id_transaksi',$request->id_transaksi)->update([
        //         'id_status' => $request->id_status,
        // ]);
        // alihkan halaman ke halaman pegawai
        return redirect('list_transaksi');
    }

    public function hapus($id_transaksi)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        DB::table('transaksi')->where('id_transaksi',$id_transaksi)->delete();
            
        // alihkan halaman ke halaman pegawai
        return redirect('/list_transaksi');
    }
 
    public function destroy($id_transaksi)
    {
        $transaksi = auth()->user()->transaksi()->find($id_transaksi);
 
        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi with id ' . $id_transaksi . ' not found'
            ], 400);
        }
 
        if ($transaksi->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi could not be deleted'
            ], 500);
        }
    }
}