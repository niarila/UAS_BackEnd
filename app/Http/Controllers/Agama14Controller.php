<?php

namespace App\Http\Controllers;

use App\Models\Agama14;
use Illuminate\Http\Request;

class Agama14Controller extends Controller
{
    public function agamaPage14()
    {
        $agama = Agama14::all();

        return view('agama', ['all_agama' => $agama]);
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

    public function createAgama14(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required'
        ]);

        $createAgama = Agama14::create([
            'nama_agama' => $request->nama_agama
        ]);

        if ($createAgama) {
            return back()->with('success', 'Agama berhasil ditambahkan');
        } else {
            return back()->with('error', 'Agama gagal ditambahkan');
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
}
