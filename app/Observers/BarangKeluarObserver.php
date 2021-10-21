<?php

namespace App\Observers;

use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Auth;

class BarangKeluarObserver
{
    public function creating(BarangKeluar $post)
    {
        $post->created_by = Auth::user()->id;
        $post->updated_by = Auth::user()->id;
    }

    public function updating(BarangKeluar $post)
    {
        $post->updated_by = Auth::user()->id;
    }
}
