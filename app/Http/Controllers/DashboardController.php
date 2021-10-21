<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $stokBarang = StokBarang::all();
        // $categories = [];
        // // $data = [];

        // foreach ($stokBarang as $stokBarang) {
        //     $categories[] = $stokBarang->jenis;
        //     // $data[] = $stokBarang->jml_barang;
        // }
        // // dd(json_encode($categories));

        return view('dashboard');
    }
}
