<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class MenuGudangController extends Controller
{
    public function index()
    {
        $dataGudang = Gudang::all();
        return view('halaman_gudang', compact('dataGudang'));
    }
}
