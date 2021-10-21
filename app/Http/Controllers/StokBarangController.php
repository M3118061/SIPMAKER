<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\DataBarang;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\DB;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $stokBarang = StokBarang::all();
    //     $dataBarang = DataBarang::all();
    //     $dataGudang = Gudang::all();
    //     return view('barang.stok.index', compact('stokBarang','dataBarang','dataGudang'));
    // }

    public function index($id_gudang)
    {
        $stokBarang = StokBarang::where('id_gudang',$id_gudang)->get();
        $dataBarang = DataBarang::all();
        $dataGudang = Gudang::all();
        $id_gudang = $id_gudang;
        return view('barang.stok.index', compact('stokBarang','dataBarang','dataGudang','id_gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_gudang)
    {
        $dataBarang = DataBarang::all();
        $dataGudang = Gudang::all();
        $id_gudang = $id_gudang;
        return view('barang.stok.create', compact('dataBarang','dataGudang','id_gudang'));
    }

    // public function createNew($id_gudang)
    // {
    //     $dataBarang = DataBarang::all();
    //     $dataGudang = Gudang::all();
    //     $id_gudang = $id_gudang;

    //     return view('barang.stok.createNew', compact('dataBarang','dataGudang','id_gudang'));
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'tgl_exp' => 'required',
            'id_gudang' => 'required',
        ]);

        StokBarang::create($request->all());

        return back()->with('success', 'Data Stok Barang Berhasil Ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function show(StokBarang $stokBarang)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(StokBarang $stokBarang)
    {
        $dataBarang = DataBarang::pluck('nama_barang','id_barang');
        $dataGudang = Gudang::pluck('nama_gudang','id_gudang');
        return view('barang.stok.edit', compact('dataBarang','stokBarang','dataGudang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StokBarang $stokBarang)
    {
        $request->validate([
            'id_barang' => 'required',
            'tgl_exp' => 'required',
            // 'id_gudang' => 'required',
        ]);

        StokBarang::where('id_stok', $stokBarang->id_stok, $stokBarang->id_barang)
                ->update([
                    'id_barang' => $request->id_barang,
                    'tgl_exp' => $request->tgl_exp,
                    // 'id_gudang' => $request->id_gudang,
                ]);

        return back()->with('success', 'Data Stok Barang Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_stok)
    {
        $stokBarang = StokBarang::findOrFail($id_stok);
        try {
            $stokBarang->delete();

        } catch (\Exception $ex) {
            return back()->with('error','Data Stok Barang Gagal Dihapus!!');
        }
        return back()->with('success', 'Data Stok Barang Berhasil Dihapus!');
    }
}
