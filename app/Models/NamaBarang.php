<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaBarang extends Model
{
    use HasFactory;

    protected $table = 'nama_barang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function asetBarangBarus()
    {
        return $this->hasMany(AsetBarangBaru::class, 'id_nama_barang');
    }

    public function asetTerbaru()
    {
        return $this->hasOne(AsetBarangBaru::class, 'id_nama_barang')
            ->latestOfMany();
    }

    public function asetBarangBekas()
    {
        return $this->hasMany(AsetBarangBekas::class, 'id_nama_barang');
    }

    public function asetBekasTerbaru()
    {
        return $this->hasOne(AsetBarangBekas::class, 'id_nama_barang')
            ->latestOfMany();
    }
}
