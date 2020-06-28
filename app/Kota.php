<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
   protected $fillable = [
        'id_kota', 'nama_kota', 'img_kota'
    ];

    protected $primaryKey = 'id_kota';
    public $table = "kota";

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'kota_id');
    }
}
