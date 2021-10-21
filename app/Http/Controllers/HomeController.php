<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\DataBarang;
use App\Models\Gudang;
use App\Models\JenisBarang;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(StokBarang $stokBarang)
    {
        $stokBarang = StokBarang::get();
        $dataBarang = DataBarang::all();
        $dataGudang = Gudang::all();
        $jenisBarang = JenisBarang::all();

        return view('dashboard', compact('stokBarang','dataBarang','dataGudang'));
    }

    public function indexPegawai(StokBarang $stokBarang, $id_gudang)
    {
        $stokBarang = StokBarang::all();
        $dataBarang = DataBarang::all();
        $dataGudang = Gudang::all();
        $jenisBarang = JenisBarang::all();
        $id_gudang = $id_gudang;

        return view('dashboard', compact('stokBarang','dataBarang','dataGudang','id_gudang'));
    }

    public function adminHome()
    {
        return view('dashboard.admin');
    }
}
