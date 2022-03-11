<?php

namespace App\Http\Controllers\API;

use App\Info;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiController extends BaseController
{
    //
    public function info(Info $info)
    {
        try {
            $authenticated_user = Auth::user();
            $user = User::with('pengguna_detail')->where('id', $authenticated_user->id)->first();
            $data = $info->where('angkatan_id', $user->pengguna_detail->angkatan_id)->orWhere('angkatan_id', null)->get();
            return $this->sendResponse($data, 'Berhasil menampilkan list info');
        } catch (\Exception $e) {
            return $this->sendError($e->errorInfo[2], null, 500);
        }
    }
}
