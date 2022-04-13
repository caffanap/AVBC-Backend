<?php

namespace App\Http\Controllers;

use App\Angkatan;
use App\Info;
use App\Pendaftaran;
use App\Posisi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $data['postingan'] = Info::where('type', 'info')->get()->count();
        $data['kegiatan'] = Info::where('type', 'kegiatan')->get()->count();
        $data['anggota'] = User::where('role', 'user')->get()->count();
        $data['wa'] = Pendaftaran::get()->filter(function($model)
        {
            return $model->link_wa;
        })->count();
        $data['grafik'] = Angkatan::with('pengguna_detail')->get();
        $data['angkatan'] = [];
        $data['jumlah_angkatan'] = [];
        foreach ($data['grafik'] as $val) {
            array_push($data['angkatan'], $val->nama);
            array_push($data['jumlah_angkatan'], count($val->pengguna_detail));
        }
        $data['posisi'] = Posisi::get();
        // return response()->json($data, 200);
        return view('dashboard', $data);
    }

    public function changePassword(User $User, Request $request)
    {
        $user_id = Auth::user()->id;
        $user = $User->find($user_id);

        if (!$user) return;

        if ($request->isMethod('post')) {
            $validator = Validator::make(
                [
                    'password_lama' => $request->password_lama,
                    'password_baru' => $request->password_baru,
                    'konfirmasi_password_baru' => $request->konfirmasi_password_baru,
                ],
                [
                    'password_lama' => 'required',
                    'password_baru' => 'required|min:8',
                    'konfirmasi_password_baru' => 'required|min:8'
                ],
                [
                    'required' => ':attribute wajib diisi',
                    'min' => ':attribute wajib mempunyai minimal 8 karakter'
                ]
            );
            if (!$validator->fails()) {
                if (!Hash::check($request->password_lama, $user->password)) {
                    $validator->getMessageBag()->add('password', 'Password lama anda tidak sama');
                } else {
                    if ($request->password_baru != $request->konfirmasi_password_baru) {
                        $validator->getMessageBag()->add('password', 'Password baru anda tidak sama dengan konfirmasi password baru');
                    } else {
                        $user->password = Hash::make($request->password_baru);
                        $user->save();
                        return view('change-password/index', compact('user'))->with('success', 'Berhasil Mengganti Password!');
                    }
                }
            }
        }
        return view('change-password/index', compact('user'))->withErrors($validator ?? null);
    }
}
