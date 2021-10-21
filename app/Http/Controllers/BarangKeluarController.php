<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\StokBarang;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $barangKeluar = BarangKeluar::all();
    //     return view('transaksi.BarangKeluar.index', compact('barangKeluar'));
    // }

    public function index($id_gudang)
    {
        $barangKeluar = BarangKeluar::where('id_gudang',$id_gudang)->get();
        $id_gudang = $id_gudang;
        return view('transaksi.BarangKeluar.index', compact('barangKeluar','id_gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $stokBarang = StokBarang::all();
    //     return view('transaksi.BarangKeluar.create',compact('stokBarang'));
    // }

    public function create($id_gudang)
    {
        $stokBarang = StokBarang::where('id_gudang',$id_gudang)->get();
        $id_gudang = $id_gudang;
        return view('transaksi.BarangKeluar.create',compact('stokBarang','id_gudang'));
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
            'id_stok' => 'required',
            'jml_barang' => 'required|numeric',
            'tgl_keluar' => 'required|date',
            'id_gudang' => 'required',
        ]);

        $stokBarang = StokBarang::findOrFail($request->id_stok);
        if ($stokBarang->jml_barang < $request->jml_barang) {
            return back()->with('error','Jumlah barang keluar tidak boleh melebihi stok');
        }
        BarangKeluar::create($request->all());
        $stokBarang->jml_barang -= $request->jml_barang;
        $stokBarang->save();

        return back()->with('success', 'Data Barang Keluar Berhasil Ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BarangKeluar $barangKeluar)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        $stokBarang = StokBarang::all();
        return view('transaksi.BarangKeluar.edit', compact('barangKeluar','stokBarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $request->validate([
            'id_stok' => 'required',
            'jml_barang' => 'required',
            'tgl_keluar' => 'required',
        ]);

        BarangKeluar::where('id_keluar', $barangKeluar->id_keluar)
                ->update([
                    'id_stok' => $request->id_stok,
                    'jml_barang' => $request->jml_barang,
                    'tgl_keluar' => $request->tgl_keluar,
                ]);

        $stokBarang = StokBarang::findOrFail($request->id_stok);
        if ($stokBarang->jml_barang < $request->jml_barang) {
            $stokBarang->jml_barang -= $request->jml_barang;
        }else{
            $stokBarang->jml_barang += $request->jml_barang;
        }
        $stokBarang->save();

        return redirect('/BarangKeluar')->with('success', 'Data Barang Masuk Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_keluar)
    {
        $barangKeluar = BarangKeluar::find($id_keluar);
        if ($barangKeluar->delete()) {
            $stokBarang = StokBarang::findOrFail($barangKeluar->id_stok);
            $stokBarang->jml_barang += $barangKeluar->jml_barang;
            $stokBarang->save();
        }
        return back()->with('message', 'Data Barang Masuk Berhasil Dihapus!');
    }
}
