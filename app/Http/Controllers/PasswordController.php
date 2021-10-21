<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function changePassword()
    {
        return view('auth.passwords.change');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $old_password = auth()->user()->password;
        $user_id = auth()->user()->id;
        
        if(Hash::check($request->input('old_password'), $old_password)){
            $user = User::find($user_id);
            $user->password = Hash::make($request->input('password'));

            if ($user->save()) {
                return redirect()->back()->with('success','Password berhasil diubah');
            }else{
                return redirect()->back()->with('error','Password lama invalid');
            }
        }else{
            return redirect()->back()->with('error','Password lama invalid');
        }
    }
}
