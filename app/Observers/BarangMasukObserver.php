<?php

namespace App\Observers;

use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Auth;

class BarangMasukObserver
{
    public function creating(BarangMasuk $post)
    {
        $post->created_by = Auth::user()->id;
        $post->updated_by = Auth::user()->id;
    }

    public function updating(BarangMasuk $post)
    {
        $post->updated_by = Auth::user()->id;
    }
}
