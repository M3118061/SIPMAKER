<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanGudangController extends Controller
{
    public function index()
    {
        return view('halaman_gudang');
    }
}
