<?php

namespace App\Http\Controllers\apiclient;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Agama14Controller extends Controller
{
    public function agamaPage14()
    {
        $client = new Client();

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");
        $getAgama = $client->request('GET', "{$API_URL}/agama14")->getBody()->getContents();

        $agama = json_decode($getAgama, true)['data'];


        return view('agama', ['all_agama' => $agama, 'Use_API' => true]);
    }

    public function editAgamaPage14(Request $request, $id)
    {
        $client = new Client();

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");
        $getAgama = $client->request('GET', "{$API_URL}/agama14/{$id}")->getBody()->getContents();

        $agama = json_decode($getAgama, true)['data'];

        if (!$agama) {
            return back()->with('error', 'Agama tidak ditemukan');
        }

        $getAllAgama = $client->request('GET', "{$API_URL}/agama14")->getBody()->getContents();
        $all_agama = json_decode($getAllAgama, true)['data'];

        return view('agama', ['all_agama' => $all_agama, 'agama' => $agama, 'Use_API' => true]);
    }

    public function createAgama14(Request $request)
    {
        $client = new Client();

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");
        $getAllAgama = $client->request('POST', "{$API_URL}/agama14", [
            'json' => [
                'nama_agama' => $request->nama_agama,
            ]
        ])->getBody()->getContents();

        $response = json_decode($getAllAgama, true)['status'];

        if ($response != true) {
            return back()->with('error', 'Agama gagal ditambahkan');
        }

        return back()->with('success', 'Agama berhasil ditambahkan');
    }

    public function updateAgama14(Request $request, $id)
    {
        $client = new Client();

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");
        $getAllAgama = $client->request('PUT', "{$API_URL}/agama14/{$id}", [
            'json' => [
                'nama_agama' => $request->nama_agama,
            ]
        ])->getBody()->getContents();

        $response = json_decode($getAllAgama, true)['status'];

        if ($response != true) {
            return back()->with('error', 'Agama gagal diubah');
        }

        return back()->with('success', 'Agama berhasil diubah');
    }

    public function deleteAgama14(Request $request, $id)
    {
        $client = new Client();

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");
        $getAllAgama = $client->request('DELETE', "{$API_URL}/agama14/{$id}")->getBody()->getContents();

        $response = json_decode($getAllAgama, true)['status'];

        return back()->with('success', 'Agama berhasil dihapus');
    }
}
