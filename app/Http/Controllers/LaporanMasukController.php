<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Gudang;
use App\Models\LaporanMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mime\Header\PathHeader;

class LaporanMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BarangMasuk $barangMasuk)
    {
        $barangMasuk = BarangMasuk::all();
        $dataGudang = Gudang::get();
        $categories = [];
        $data = [];

        foreach ($barangMasuk as $masuk) {
            $categories[] = $masuk->stokBarang->databarang->nama_barang;
            $data[] = $masuk->jml_barang;
        }
        return view('laporan.barangmasuk.index', compact('barangMasuk','dataGudang','categories','data'));
    }

    public function cetakBarangMasuk(){
        $barangMasuk = BarangMasuk::get();
        $total = BarangMasuk::sum('jml_barang');
        return view('transaksi.BarangMasuk.cetak', compact('barangMasuk','total'));
    }

    // public function CetakMasukPertanggal($tglawal, $tglakhir)
    // {
    //     // dd("tanggal awal : ".$tglawal, "tanggal akhir : ".$tglakhir);
    //     $barangMasuk = BarangMasuk::with('supplier','stokBarang')->whereBetween('tgl_masuk',[$tglawal, $tglakhir])->get();
    //     $totalmasukPertanggal = BarangMasuk::whereBetween('tgl_masuk',[$tglawal, $tglakhir])->sum('jml_barang');
    //     return view('laporan.barangmasuk.cetak', compact('barangMasuk','totalmasukPertanggal'));
    // }
    
    public function CetakMasukPertanggal(Request $request)
    {
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $gudang = $request->id_gudang;

        $barangMasuk = BarangMasuk::where('tgl_masuk','>=',$tglawal)
                                    ->where('tgl_masuk','<=',$tglakhir)
                                    ->where('id_gudang',$gudang)
                                    ->get();
        $totalmasukPertanggal = BarangMasuk::where('tgl_masuk','>=',$tglawal)
                                            ->where('tgl_masuk','<=',$tglakhir)
                                            ->where('id_gudang',$gudang)
                                            ->sum('jml_barang');
        return view('laporan.barangmasuk.cetak', compact('barangMasuk','totalmasukPertanggal','tglawal','tglakhir'));
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
     * @param  \App\Models\LaporanMasuk  $laporanMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanMasuk $laporanMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanMasuk  $laporanMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanMasuk $laporanMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanMasuk  $laporanMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanMasuk $laporanMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanMasuk  $laporanMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanMasuk $laporanMasuk)
    {
        //
    }
}
