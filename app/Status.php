<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'id_status', 'nama_status'
    ];

    public $table = 'status';
    protected $primaryKey = 'id_status';

    // public function transaksi()
    // {
    //     return $this->belongsTo(Transaksi::class, 'id_store');
    // }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_status');
    }
}
