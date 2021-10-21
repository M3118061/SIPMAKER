<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Gudang;
use App\Models\LaporanKeluar;
use Illuminate\Http\Request;

class LaporanKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BarangKeluar $barangKeluar)
    {
        $barangKeluar = BarangKeluar::all();
        $dataGudang = Gudang::get();
        $categories = [];
        $data = [];

        foreach ($barangKeluar as $keluar) {
            $categories[] = $keluar->stokBarang->databarang->nama_barang;
            $data[] = $keluar->jml_barang;
        }
        return view('laporan.barangkeluar.index',compact('barangKeluar','dataGudang','categories','data'));
    }

    public function cetakBarangKeluar()
    {
        $barangKeluar = BarangKeluar::get();
        $total = BarangKeluar::sum('jml_barang');
        return view('transaksi.BarangKeluar.cetak', compact('barangKeluar','total'));
    }

    // public function CetakKeluarPertanggal($tglawal, $tglakhir)
    // {
    //     // dd("tanggal awal : ".$tglawal, "tanggal akhir : ".$tglakhir);
    //     // $barangKeluar = BarangKeluar::get()->whereBetween('tgl_keluar',[$tglawal, $tglakhir]);
    //     $barangKeluar = BarangKeluar::with('stokBarang')->whereBetween('tgl_keluar',[$tglawal, $tglakhir])->get();
    //     $totalkeluarPertanggal = BarangKeluar::whereBetween('tgl_keluar',[$tglawal, $tglakhir])->sum('jml_barang');
    //     return view('laporan.barangkeluar.cetak', compact('barangKeluar','totalkeluarPertanggal'));
    // }

    public function CetakKeluarPertanggal(Request $request)
    {
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $gudang = $request->id_gudang;

        $barangKeluar = BarangKeluar::where('tgl_keluar','>=',$tglawal)
                                    ->where('tgl_keluar','<=',$tglakhir)
                                    ->where('id_gudang',$gudang)
                                    ->get();
        $totalkeluarPertanggal = BarangKeluar::where('tgl_keluar','>=',$tglawal)
                                            ->where('tgl_keluar','<=',$tglakhir)
                                            ->where('id_gudang',$gudang)
                                            ->sum('jml_barang');
        return view('laporan.barangkeluar.cetak', compact('barangKeluar','totalkeluarPertanggal','tglawal','tglakhir'));
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
     * @param  \App\Models\LaporanKeluar  $laporanKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanKeluar $laporanKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanKeluar  $laporanKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanKeluar $laporanKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKeluar  $laporanKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanKeluar $laporanKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanKeluar  $laporanKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanKeluar $laporanKeluar)
    {
        //
    }
}
