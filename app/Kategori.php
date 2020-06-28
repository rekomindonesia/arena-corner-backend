<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'id_kategori', 'kota_id', 'kategori_name', 
    ];

    public function store()
    {
        return $this->hasMany(Store::class, 'kategori_id');
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public $table = 'kategori';
    protected $primaryKey = 'id_kategori';
}
