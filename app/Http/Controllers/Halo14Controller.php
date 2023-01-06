<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Agama14;


class Halo14Controller extends Controller
{
    public function halo14()
    {
        $user = User::where('role', 'user')->get();
        $agama = Agama14::all();

        return view('welcome', ['data' => $user, 'agama' => $agama]);
    }


}
