<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\BarangMasuk;
use App\Models\DataBarang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    // public function index()
    // {
    //     $barangMasuk = BarangMasuk::all();
    //     return view('transaksi.BarangMasuk.index', compact('barangMasuk'));
    // }

    public function index($id_gudang)
    {
        $barangMasuk = BarangMasuk::where('id_gudang',$id_gudang)->get();
        $id_gudang = $id_gudang;
        return view('transaksi.BarangMasuk.index', compact('barangMasuk','id_gudang'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $stokBarang = StokBarang::all();
    //     $supplier = Supplier::all();
    //     return view('transaksi.BarangMasuk.create',compact('supplier','stokBarang'));
    // }

    public function create($id_gudang)
    {
        $stokBarang = StokBarang::where('id_gudang',$id_gudang)->get();
        $supplier = Supplier::all();
        $id_gudang = $id_gudang;
        return view('transaksi.BarangMasuk.create',compact('supplier','stokBarang','id_gudang'));
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
            'jml_barang' => 'required',
            'tgl_masuk' => 'required',
            'id_supplier' => 'required',
            'id_gudang' => 'required',
        ]);

        BarangMasuk::create($request->all());

        $stokBarang = StokBarang::findOrFail($request->id_stok);
        $stokBarang->jml_barang += $request->jml_barang;
        $stokBarang->save();

        return back()->with('success', 'Barang Masuk Berhasil Ditambahkan!!');
    }

    public function uploadsurat(Request $request)
    {
        $request->validate([
            'surat_masuk' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('suratTerimaUpload'), $fileName);

        return redirect('/BarangMasuk')
            ->with('success','You have successfully upload file.')
            ->with('surat_masuk',$fileName);
    }

    //download template surat
    public function public_download()
    {
        $path = public_path('suratTerima/suratterima.docx');
        return response()->download($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $dataBarang = DataBarang::all();
        $stokBarang = StokBarang::all();
        $supplier = Supplier::pluck('nama_supplier','id_supplier');
        return view('transaksi.BarangMasuk.edit', compact('dataBarang','stokBarang','supplier','barangMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'id_stok' => 'required',
            'jml_barang' => 'required',
            'tgl_masuk' => 'required',
            'id_supplier' => 'required',
        ]);

        BarangMasuk::where('id_masuk', $barangMasuk->id_masuk)
                ->update([
                    'id_stok' => $request->id_stok,
                    'jml_barang' => $request->jml_barang,
                    'tgl_masuk' => $request->tgl_masuk,
                    'id_supplier' => $request->id_supplier,
                ]);

        $stokBarang = StokBarang::findOrFail($request->id_stok);
        if ($stokBarang->jml_barang < $request->jml_barang) {
            $stokBarang->jml_barang += $request->jml_barang;
        }else{
            $stokBarang->jml_barang -= $request->jml_barang;
        }
        $stokBarang->save();

        return back()->with('success', 'Data Barang Masuk Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_masuk)
    {
        $barangMasuk = BarangMasuk::find($id_masuk);
        if ($barangMasuk->delete()) {
            $stokBarang = StokBarang::findOrFail($barangMasuk->id_stok);
            $stokBarang->jml_barang -= $barangMasuk->jml_barang;
            $stokBarang->save();
        }

        return back()->with('success', 'Data Barang Masuk Berhasil Dihapus!');
    }
}
