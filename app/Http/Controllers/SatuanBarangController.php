<?php

namespace App\Http\Controllers;

use App\Models\SatuanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->SatuanBarang = new SatuanBarang();
    }

    public function index()
    {
        $satuanBarang = SatuanBarang::all();
        return view('barang.satuan.index', compact('satuanBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.satuan.create');
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
            'nama_satuan' => 'required'
        ]);

        SatuanBarang::create($request->all());

        return redirect('/satuan')->with('success', 'Data Satuan Barang Berhasil Ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function show($id_jenis)
    {
        $data = [
            'barang' => $this->SatuanBarang->databarang($id_jenis),
        ];
        return view('barang.satuan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(SatuanBarang $satuanBarang)
    {
        return view('barang.satuan.edit', compact('satuanBarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SatuanBarang $satuanBarang)
    {
        $request->validate([
            'nama_satuan' => 'required'
        ]);

        SatuanBarang::where('id_satuan', $satuanBarang->id_satuan)
                    ->update([
                        'nama_satuan' => $request->nama_satuan
                    ]);
        
        return redirect('/satuan')->with('success', 'Data Satuan Barang Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_satuan)
    {
        $satuanBarang = SatuanBarang::findOrFail($id_satuan);
        try {
            $satuanBarang->delete();
            
        } catch (\Exception $ex) {
            return redirect('/satuan')->with('error','Data Satuan Barang Gagal Dihapus!!');
        }
        return redirect('/satuan')->with('success','Data Satuan Barang Berhasil Dihapus!!');
    }
}
