<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'kategori_id', 'name_store', 'no_telp', 'alamat', 'harga', 'img_store'
    ];

    public $table = 'store';
    protected $primaryKey = 'id_store';

    // public function transaksi()
    // {
    //     return $this->belongsTo(Transaksi::class, 'id_store');
    // }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_store');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
