<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';
    protected $fillable = ['id_stok','jml_barang','tgl_keluar','id_gudang'];

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'id_stok');
    }

    public function datagudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
