<?php

namespace App\Observers;

use App\Models\StokBarang;
use Illuminate\Support\Facades\Auth;

class StokBarangObserver
{
    public function creating(StokBarang $post)
    {
        $post->created_by = Auth::user()->id;
        $post->updated_by = Auth::user()->id;
    }

    public function updating(StokBarang $post)
    {
        $post->updated_by = Auth::user()->id;
    }
}
