<?php

namespace App\Http\Controllers;

use App\Models\Data14;
use App\Models\User;
use Illuminate\Http\Request;

class Register14Controller extends Controller
{
    public function register14(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users14',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ]);

        $userData = $request->all();
        $userData["password"] = bcrypt($request->password);
        $userData["is_active"] = 0;

        $user = new User();
        $user->fill($userData);
        $save = $user->save();

        $detailUser = new Data14();
        $detailUser->id_user = $user->id;
        $detailUser->save();

        if ($save && $detailUser) {
            return redirect('/login14')->with('success', 'Register Success');
        } else {
            return back()->with('error', 'Register failed!');
        }
    }

}
