<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->Gudang = new Gudang();
    }

    public function index()
    {
        $gudang = Gudang::all();
        return view('gudang.index', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.create');
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
            'nama_gudang' => 'required',
        ]);

        Gudang::create($request->all());

        return redirect('/gudang')->with('success', 'Data Gudang Barang Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function show($id_gudang)
    {

        // $stokBarang = StokBarang::all();
        $data = [
            'stokBarang' => $this->Gudang->stok($id_gudang),
        ];
        return view('barang.stok.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function edit(Gudang $gudang)
    {
        return view('gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama_gudang' => 'required'
        ]);

        Gudang::where('id_gudang', $gudang->id_gudang)
                    ->update([
                        'nama_gudang' => $request->nama_gudang
                    ]);

        return redirect('/gudang')->with('success', 'Data Jenis Barang Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_gudang)
    {
        $gudang = Gudang::findOrFail($id_gudang);
        try {
            $gudang->delete();
            
        } catch (\Exception $ex) {
            return redirect('/gudang')->with('error','Data Gudang Gagal Dihapus!!');
        }
        return redirect('/gudang')->with('success','Data Gudang Berhasil Dihapus!!');
    }
}
