<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Transaksi extends Model
{
    protected $fillable = [
        'id_transaksi', 'user_id', 'id_store', 'waktu_service', 'tgl_service', 'catatan_service', 'id_status'
    ];

    protected $primaryKey = 'id_transaksi';
    public $table = "transaksi";

    // public function store()
    // {
    //     return $this->hasMany(Store::class, 'id_store');
    // }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function service(){
    	return $this->hasMany(Service::class);
    }

    public function status(){
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function bukti(){
        return $this->hasMany(Bukti::class);
    }    

}
