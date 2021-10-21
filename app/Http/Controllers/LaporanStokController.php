<?php

namespace App\Http\Controllers;

use App\Models\LaporanStok;
use App\Models\StokBarang;
use App\Models\DataBarang;
use App\Models\Gudang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class LaporanStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StokBarang $stokBarang)
    {
        $stokBarang = StokBarang::all();
        $dataGudang = Gudang::get();

        $categories = [];
        $data = [];

        foreach ($stokBarang as $stok) {
            $categories[] = $stok->databarang->nama_barang;
            $data[] = $stok->jml_barang;
        }
        
        return view('laporan.stokbarang.index', compact('stokBarang','dataGudang','data','categories'));
    }

    public function cetakStok()
    {
        $stokBarang = StokBarang::get();
        $dataBarang = DataBarang::get();
        $dataGudang = Gudang::get();
        $total = StokBarang::sum('jml_barang');
        // dd($stokBarang);
        return view('barang.stok.cetak', compact('stokBarang','dataBarang','dataGudang','total'));
    }

    // public function CetakStokPertanggal($tglawal, $tglakhir)
    // {
    //     // dd("tanggal awal : ".$tglawal, "tanggal akhir : ".$tglakhir);
    //     $stokBarang = StokBarang::with('dataBarang')->whereBetween('tgl_exp',[$tglawal, $tglakhir])->get();
    //     $totalstokPertanggal = StokBarang::whereBetween('tgl_exp',[$tglawal, $tglakhir])->sum('jml_barang');
    //     // dd($totalstokPertanggal);
    //     return view('laporan.stokbarang.cetak', compact('stokBarang','totalstokPertanggal'));
    // }
    
    public function CetakStokPertanggal(Request $request)
    {
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $gudang = $request->id_gudang;

        $stokBarang = StokBarang::where('tgl_exp','>=',$tglawal)
                                    ->where('tgl_exp','<=',$tglakhir)
                                    ->where('id_gudang',$gudang)
                                    ->get();
        $totalstokPertanggal = StokBarang::where('tgl_exp','>=',$tglawal)
                                            ->where('tgl_exp','<=',$tglakhir)
                                            ->where('id_gudang',$gudang)
                                            ->sum('jml_barang');
        return view('laporan.stokbarang.cetak', compact('stokBarang','totalstokPertanggal','tglawal','tglakhir'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanStok  $laporanStok
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanStok $laporanStok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanStok  $laporanStok
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanStok $laporanStok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanStok  $laporanStok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanStok $laporanStok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanStok  $laporanStok
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanStok $laporanStok)
    {
        //
    }
}
