<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
   protected $fillable = [
        'id_transaksi',
    ];

    protected $primaryKey = 'id_histori';
    public $table = "histori";
}
