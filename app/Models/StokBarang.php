<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;
    protected $table = 'stok_barang';
    protected $primaryKey = 'id_stok';
    protected $fillable = ['id_barang','tgl_exp','id_gudang'];

    public function databarang()
    {
        return $this->belongsTo(DataBarang::class, 'id_barang');
    }

    public function datagudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
