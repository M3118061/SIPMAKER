<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuGudang extends Model
{
    use HasFactory;
    public function stok($id_gudang)
    {
        // return DB::table('data_gudang')
        //         ->join('stok_barang', 'data_gudang.id_gudang', '=', 'stok_barang.id_gudang')
        //         // ->select('jenis_barang.nama_jenis', 'data_barang.nama_barang', 'data_barang.kode_barang')
        //         ->where('stok_barang.id_gudang', '=', $id_gudang)
        //         ->get()->toArray();
        
        return StokBarang::where('id_gudang', $id_gudang)->get();
        
                // dd($cek);

    }
}
