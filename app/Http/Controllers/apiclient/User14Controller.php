<?php

namespace App\Http\Controllers\apiclient;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class User14Controller extends Controller
{
    public function dashboardPage14()
    {
        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $getUser = $client->request('GET', "{$API_URL}/user14")->getBody()->getContents();
        $getAgama = $client->request('GET', "{$API_URL}/agama14")->getBody()->getContents();

        $user = json_decode($getUser, true)['data'];
        $agama = json_decode($getAgama, true)['data'];

        return view('dashboard', ['data' => $user, 'agama' => $agama, 'Use_API' => true]);
    }

    public function profilePage14()
    {
        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();
        $user = Auth::user();

        $getUser = $client->request('GET', "{$API_URL}/user14/{$user->id}")->getBody()->getContents();
        $getAgama = $client->request('GET', "{$API_URL}/agama14")->getBody()->getContents();

        $user = json_decode($getUser, true)['data'];
        $agama = json_decode($getAgama, true)['data'];

        return view('profile', ['user' => $user, 'agama' => $agama, 'is_preview' => false, 'Use_API' => true]);
    }

    public function detailPage14(Request $request, $id)
    {
        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();
        $getUser = $client->request('GET', "{$API_URL}/user14/{$id}")->getBody()->getContents();
        $user = json_decode($getUser, true)['data'];

        if (!$user) {
            return redirect('dashboard')->with('error', 'User tidak ditemukan');
        }

        $getAgama = $client->request('GET', "{$API_URL}/agama14")->getBody()->getContents();
        $agama = json_decode($getAgama, true)['data'];

        return view('profile', ['user' => $user, 'agama' => $agama, 'is_preview' => true]);
    }

    public function putUserDetail14(Request $request)
    {

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users14,email,' . $user->id,
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_agama' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'User gagal diubah');
        }

        $putUser = $client->request('PUT', "{$API_URL}/user14/{$user->id}", [
            'json' => [
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'id_agama' => $request->id_agama,
            ]
        ])->getBody()->getContents();

        $response = json_decode($putUser, true)['status'];

        if ($response != true) {
            return back()->with('error', 'User gagal diubah');
        }

        return back()->with('success', 'User berhasil diubah');
    }

    public function putUserAgama14(Request $request, $id)
    {

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $validator = Validator::make($request->all(), [
            'agama' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'User gagal diubah');
        }

        $putUserAgama = $client->request('PUT', "{$API_URL}/user14/{$id}/agama", [
            'json' => [
                'id_agama' => $request->agama,
            ]
        ])->getBody()->getContents();


        $response = json_decode($putUserAgama, true)['status'];

        if ($response != true) {
            return back()->with('error', 'User gagal diubah');
        }

        return back()->with('success', 'User berhasil diubah');
    }

    public function putUserStatus14(Request $request, $id)
    {

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $user = User::find($id);

        $putUserStatus = $client->request('PUT', "{$API_URL}/user14/{$id}/status", [
            'json' => [
                'is_active' => $user->is_active == 1 ? 0 : 1,
            ]
        ])->getBody()->getContents();

        $response = json_decode($putUserStatus, true)['status'];

        if ($response != true) {
            return back()->with('error', 'User gagal diubah');
        }

        return back()->with('success', 'User berhasil diubah');
    }

    public function putUserPassword14(Request $request)
    {

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Pastikan semua field terisi dengan benar');
        }

        $putUserPassword = $client->request('PUT', "{$API_URL}/user14/{$user->id}/password", [
            'json' => [
                'old_password' => $request->old_password,
                'password' => $request->password,
                'repassword' => $request->repassword,
            ]
        ])->getBody()->getContents();

        $response = json_decode($putUserPassword, true)['status'];

        if ($response != true) {
            return back()->with('error', 'Password gagal diubah');
        }

        return back()->with('success', 'Password berhasil diubah');
    }


    public function putUserPhoto14(Request $request)
    {

        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'photoProfil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Pastikan semua field terisi dengan benar');
        }

        $photo = $request->file('photoProfil');
        $fileNameTmp = time() . $photo->getClientOriginalName();
        $photo->move(public_path('tmp'), $fileNameTmp);

        $putUserPhoto = $client->request('PUT', "{$API_URL}/user14/{$id}/photo", [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => [
                'photoProfil' => $fileNameTmp,
            ]
        ])->getBody()->getContents();

        $response = json_decode($putUserPhoto, true)['status'];

        if ($response != true) {
            return back()->with('error', 'Photo gagal diubah');
        }

        return back()->with('success', 'Photo berhasil diubah');
    }

    public function putUserPhotoKTP14(Request $request)
    {
        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'photoKTP' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Pastikan semua field terisi dengan benar');
        }

        $photo = $request->file('photoKTP');
        $fileNameTmp = time() . $photo->getClientOriginalName();
        $photo->move(public_path('tmp'), $fileNameTmp);

        $putUserPhoto = $client->request('PUT', "{$API_URL}/user14/{$id}/photoKTP", [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => [
                'photoKTP' => $fileNameTmp,
            ]
        ])->getBody()->getContents();

        $response = json_decode($putUserPhoto, true)['status'];

        if ($response != true) {
            return back()->with('error', 'photoKTP gagal diubah');
        }

        return back()->with('success', 'photoKTP berhasil diubah');
    }

    public function deleteUser14($id)
    {
        $API_URL = env('API_URL', "http://localhost/BackEnd/UAS-Backend/public/api");

        $client = new Client();

        $deleteUser = $client->request('DELETE', "{$API_URL}/user14/{$id}", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ])->getBody()->getContents();

        $response = json_decode($deleteUser, true)['status'];

        if ($response != true) {
            return back()->with('error', 'User gagal dihapus');
        }

        return back()->with('success', 'User berhasil dihapus');
    }
}
