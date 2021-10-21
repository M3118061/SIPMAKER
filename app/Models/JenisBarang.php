<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\VarDumper\Cloner\Data;

class JenisBarang extends Model
{
    use HasFactory;
    protected $table = 'jenis_barang';
    protected $primaryKey = 'id_jenis';
    protected $fillable = ['nama_jenis'];
    protected $hidden = ['created_at','update_at'];

    public function databarang($id_jenis)
    {
        return DB::table('jenis_barang')
                ->join('data_barang', 'jenis_barang.id_jenis', '=', 'data_barang.id_jenis')
                ->select('jenis_barang.nama_jenis', 'data_barang.nama_barang', 'data_barang.kode_barang')
                ->where('data_barang.id_jenis', '=', $id_jenis)
                ->get()->toArray();
    }
}
