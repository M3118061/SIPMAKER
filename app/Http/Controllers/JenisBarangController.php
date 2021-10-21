<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBarang;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->JenisBarang = new JenisBarang;
    }

    public function index()
    {
        $jenisBarang = JenisBarang::all();
        
        return view('barang.jenis.index', compact('jenisBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.jenis.create');
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
            'nama_jenis' => 'required',
        ]);

        JenisBarang::create($request->all());

        return redirect('/jenis')->with('success', 'Data Jenis Barang Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function show($id_jenis)
    {
        $data = [
            'barang' => $this->JenisBarang->databarang($id_jenis),
        ];
        return view('barang.jenis.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisBarang $jenisBarang)
    {
        return view('barang.jenis.edit', compact('jenisBarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisBarang $jenisBarang)
    {
        $request->validate([
            'nama_jenis' => 'required'
        ]);

        JenisBarang::where('id_jenis', $jenisBarang->id_jenis)
                    ->update([
                        'nama_jenis' => $request->nama_jenis
                    ]);

        return redirect('/jenis')->with('success', 'Data Jenis Barang Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jenis)
    {
        $jenisBarang = JenisBarang::findOrFail($id_jenis);
        try {
            $jenisBarang->delete();
            
        } catch (\Exception $ex) {
            return redirect('/jenis')->with('error','Data Jenis Barang Gagal Dihapus!!');
        }
        return redirect('/jenis')->with('success','Data Jenis Barang Berhasil Dihapus!!');
    }
}
