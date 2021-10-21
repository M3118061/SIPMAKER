<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('akun.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Akun $akun)
    {
        $request->validate([
            'name'      => 'required|min:3',
            'exp_reminder'  => 'required|numeric',
            
        ],
        [
            'name.required'     => 'Name belum diisi!',
            'name.min'          => 'Name minimal 3 karakter!',
            'exp_reminder.required' => 'Pengingat Expired belum diisi!',
            'exp_reminder.numeric'  => 'Pengingat Expired harus berupa angka!',
        ]);

        $data = [
            "name"          => $request->name,
            "exp_reminder"  => $request->exp_reminder,
        ];

        if($request->name != Auth::user()->name || $request->exp_reminder != Auth::user()->exp_reminder){
            $update = DB::table('users')->where("id", Auth::user()->id)->update($data);

            if($update){
                $request->session()->flash("success", "Profile berhasil diperbarui.");
            } else {
                $request->session()->flash("error", "Profile gagal diperbarui!");
            }
        } else {
            $request->session()->flash("error", "Tidak ada perubahan!");
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun)
    {
        //
    }
}
