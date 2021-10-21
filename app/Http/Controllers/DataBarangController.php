<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\VarDumper\Cloner\Data;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataBarang = DataBarang::all();
        
        return view('barang.dataBarang.index', compact('dataBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisBarang = JenisBarang::all();
        $satuanBarang = SatuanBarang::all();

        //BR2021910000001

        $now = Carbon::now();
        $thnbulan = $now->year.$now->month;
        $cek = DataBarang::count();

        if ($cek == 0) {
            $urut = 10000001;
            $nomor = 'BR'.$thnbulan.$urut;
        }else{
            $ambil = DataBarang::all()->last();
            $urut = (int)substr($ambil->kode_barang, -8) + 1;
            $nomor = 'BR'.$thnbulan.$urut;
        }
        // dd($cek);

        return view('barang.dataBarang.create', compact('jenisBarang','satuanBarang','nomor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:data_barang,kode_barang',
            'nama_barang' => 'required',
            'id_jenis' => 'required',
            'id_satuan' => 'required',
        ]);

        DataBarang::create($request->all());

        return redirect('/dataBarang')->with('success', 'Data barang berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataBarang  $dataBarang
     * @return \Illuminate\Http\Response
     */
    public function show(DataBarang $dataBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataBarang  $dataBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(DataBarang $dataBarang)
    {
        $jenisBarang = JenisBarang::pluck('nama_jenis','id_jenis');
        $satuanBarang = SatuanBarang::pluck('nama_satuan','id_satuan');
        return view('barang.dataBarang.edit', compact('dataBarang','jenisBarang','satuanBarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataBarang  $dataBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataBarang $dataBarang)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'id_jenis' => 'required',
            'id_satuan' => 'required',
        ]);

        DataBarang::where('id_barang', $dataBarang->id_barang)
                  ->update([
                      'kode_barang' => $request->kode_barang,
                      'nama_barang' => $request->nama_barang,
                      'id_jenis' => $request->id_jenis,
                      'id_satuan' => $request->id_satuan,
                  ]);
        
        return redirect('/dataBarang')->with('success','Data barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataBarang  $dataBarang
     * @return \Illuminate\Http\Response
     */

    public function destroy($id_barang)
    {
        $dataBarang = DataBarang::findOrFail($id_barang);
        try {
            $dataBarang->delete();
            
        } catch (\Exception $ex) {
            return redirect('/dataBarang')->with('error','Data Barang Gagal Dihapus!!');
        }
        return redirect('/dataBarang')->with('success','Data Barang Berhasil Dihapus!!');
    }
}
