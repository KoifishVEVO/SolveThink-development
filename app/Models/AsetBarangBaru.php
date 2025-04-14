<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetBarangBaru extends Model
{
    use HasFactory;

    protected $table = 'aset_barang_baru';

    protected $guarded = ['id'];

    public function namaBarang()
    {
        return $this->belongsTo(NamaBarang::class, 'id_nama_barang');
    }
}
