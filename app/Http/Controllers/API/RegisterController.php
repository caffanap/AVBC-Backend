<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\PenggunaDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'no_telp' => 'required',
            'angkatan_id' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan_id' => 'required',
            'nim' => 'required',
            'posisi_id' => 'required',
            'foto' => ['nullable', 'sometimes', 'mimes:jpg,png,jpeg', 'max:2048'],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        if ($request->foto) {
            $photoPath = url('/photo')."/".Str::uuid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('photo'), $photoPath);
        } else {
            $photoPath = null;
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        try {
            DB::beginTransaction();
            $user = User::create($input);

            $detail = PenggunaDetail::create([
                'user_id' => $user->id,
                'angkatan_id' => $request->angkatan_id,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jurusan_id' => $request->jurusan_id,
                'nim' => $request->nim,
                'prestasi' => $request->prestasi,
                'foto' => $photoPath,
                'alumni' => 0,
            ]);

            DB::commit();

            $success['token'] =  $user->createToken('Avbc')->accessToken;
            $success['user'] =  $user;
            $success['user']['pengguna_detail'] = $detail;
            return $this->sendResponse($success, 'User register successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authenticated_user = Auth::user();
            $user = User::with('pengguna_detail')->where('id', $authenticated_user->id)->first();
            $success['token'] = $user->createToken('Avbc')->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
