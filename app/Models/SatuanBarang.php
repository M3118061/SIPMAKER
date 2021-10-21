<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    use HasFactory;
    protected $table = 'satuan_barang';
    protected $primaryKey = 'id_satuan';
    protected $fillable = ['nama_satuan'];

    public function databarang($id_satuan)
    {
        return DB::table('satuan_barang')
                ->join('data_barang', 'satuan_barang.id_satuan', '=', 'data_barang.id_satuan')
                ->select('satuan_barang.nama_satuan', 'data_barang.nama_barang', 'data_barang.kode_barang')
                ->where('data_barang.id_satuan', '=', $id_satuan)
                ->get()->toArray();
    }
}
