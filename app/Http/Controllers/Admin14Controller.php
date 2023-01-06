<?php

namespace App\Http\Controllers;

use App\Models\Agama14;
use App\Models\User;
use Illuminate\Http\Request;

class Admin14Controller extends Controller
{

    public function dashboardPage14()
    {
        $user = User::where('role', 'user')->get();
        $agama = Agama14::all();

        return view('dashboard', ['data' => $user, 'agama' => $agama]);
    }

    public function detailPage14(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard14')->with('error', 'User tidak ditemukan');
        }

        $agama = Agama14::all();

        $detail = $user->detail;
        $data = array_merge($user->toArray(), $detail->toArray());

        return view('profile', ['user' => $data, 'agama' => $agama, 'is_preview' => true]);
    }

    public function updateUserStatus14(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard14')->with('error', 'User tidak ditemukan');
        }

        $updateStatus = $user->update([
            'is_active' => $user->is_active == 1 ? 0 : 1
        ]);

        if ($updateStatus) {
            return redirect('/dashboard14')->with('success', 'Status berhasil diubah');
        } else {
            return redirect('/dashboard14')->with('error', 'Status gagal diubah');
        }
    }

    public function deleteUser14(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard14')->with('error', 'User tidak ditemukan');
        }

        $deleteUser = $user->delete();

        if ($deleteUser) {
            return redirect('/dashboard14')->with('success', 'User berhasil dihapus');
        } else {
            return redirect('/dashboard14')->with('error', 'User gagal dihapus');
        }
    }

    public function agamaPage14()
    {
        $agama = Agama14::all();

        return view('agama', ['all_agama' => $agama]);
    }

    public function createAgama14(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required'
        ]);

        $createAgama = Agama14::create([
            'nama_agama' => $request->nama_agama
        ]);

        if ($createAgama) {
            return redirect('/agama14')->with('success', 'Agama berhasil ditambahkan');
        } else {
            return redirect('/agama14')->with('error', 'Agama gagal ditambahkan');
        }
    }

    public function editAgamaPage14(Request $request)
    {

        $id = $request->id;

        $agama = Agama14::find($id);

        if (!$agama) {
            return back()->with('error', 'Agama tidak ditemukan');
        }

        $all_agama = Agama14::all();

        return view('agama', ['all_agama' => $all_agama, 'agama' => $agama]);
    }


    public function updateUserAgama14(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard14')->with('error', 'User tidak ditemukan');
        }

        $request->validate([
            'agama' => 'required|exists:agama14,id'
        ]);

        $user->detail->id_agama = $request->agama;
        $updateAgama = $user->detail->save();

        if ($updateAgama) {
            return redirect('/dashboard14')->with('success', 'Agama berhasil diubah');
        } else {
            return redirect('/dashboard14')->with('error', 'Agama gagal diubah');
        }
    }


    public function deleteAgama14(Request $request)
    {
        $id = $request->id;
        $agama = Agama14::find($id);

        if (!$agama) {
            return redirect('/agama14')->with('error', 'Agama tidak ditemukan');
        }

        $deleteAgama = $agama->delete();


        if ($deleteAgama) {
            return redirect('/agama14')->with('success', 'Agama berhasil dihapus');
        } else {
            return redirect('/agama14')->with('error', 'Agama gagal dihapus');
        }
    }

    public function updateAgama14(Request $request)
    {
        $id = $request->id;
        $agama = Agama14::find($id);

        if (!$agama) {
            return redirect('/agama14')->with('error', 'Agama tidak ditemukan');
        }

        $request->validate([
            'nama_agama' => 'required'
        ]);

        $updateAgama = $agama->update([
            'nama_agama' => $request->nama_agama
        ]);

        if ($updateAgama) {
            return redirect('/agama14')->with('success', 'Agama berhasil diubah');
        } else {
            return redirect('/agama14')->with('error', 'Agama gagal diubah');
        }
    }

}
