<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        //insert ke tabel user
        $user = new User;
        $user->role = $request->role;
        $user->name = $request->name;
        $user->jk = $request->jk;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->email = $request->email;
        $user->save();

        return redirect('/user')->with('success', 'Data Pengguna Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        User::where('id', $user->id)
                ->update([
                    'name' => $request->name,
                    'jk' => $request->jk,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                    'email' => $request->email,
                    'role' => $request->role,
                ]);

        return redirect('/user')->with('success', 'Data Pengguna Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user')->with('success', 'Data Pengguna Berhasil Dihapus!');
    }

    public function status($id)
    {
        $user = DB::table('users')->where('id',$id)->first();
        $status_sekarang = $user->status;
        if ($status_sekarang == 1) {
            DB::table('users')->where('id',$id)->update([
                'status'=>0
            ]);
        }else{
            DB::table('users')->where('id',$id)->update([
                'status'=>1
            ]);
        }
        return redirect('/user')->with('success', 'Status berhasil diubah!');
    }
}
