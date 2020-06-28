<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Bukti extends Model
{
    protected $fillable = [
        'id_bukti', 'id_transaksi', 'tgl_service', 'catatan_service', 'img_tf'
    ];

    protected $primaryKey = 'id_bukti';
    public $table = "bukti";

    // public function store()
    // {
    //     return $this->hasMany(Store::class, 'id_store');
    // }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

}
