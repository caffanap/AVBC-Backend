<?php

namespace App\Http\Controllers\API;

use App\Angkatan;
use App\Faq;
use App\Info;
use App\Pendaftaran;
use App\PenggunaDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CsInformasiController extends BaseController
{
    //
    public function info(Info $info)
    {
        $authenticated_user = Auth::user();
        if ($authenticated_user) {
            try {
                $user = User::with('pengguna_detail')->where('id', $authenticated_user->id)->first();
                $data = $info->where('angkatan_id', $user->pengguna_detail->angkatan_id)->orWhere('angkatan_id', null)->get();
                return $this->sendResponse($data, 'Berhasil menampilkan list info');
            } catch (\Exception $e) {
                return $this->sendError($e->errorInfo[2], null, 500);
            }
        } else {
            try {
                $data = $info->where('angkatan_id', null)->get();
                return $this->sendResponse($data, 'Berhasil menampilkan list info');
            } catch (\Exception $e) {
                return $this->sendError($e->errorInfo[2], null, 500);
            }
        }
    }

    public function faq(Faq $faq)
    {
        try {
            $data = $faq->get();
            return $this->sendResponse($data, 'Berhasil menampilkan list faq');
        } catch (\Exception $e) {
            return $this->sendError($e->errorInfo[2], null, 500);
        }
    }

    public function temanAngkatan(Request $request, Angkatan $angkatan)
    {
        try {
            if ($request->angkatan) {
                $data = $angkatan->with('pengguna_detail.user')->where('id', $request->angkatan)->first();
            } else {
                $data = $angkatan->with('pengguna_detail.user')->get();
            }
            return $this->sendResponse($data, 'Berhasil menampilkan list teman angkatan');
        } catch (\Exception $e) {
            return $this->sendError($e->errorInfo[2], null, 500);
        }
    }

    public function hariPendaftaranDibuka(Pendaftaran $pendaftaran)
    {
        try {
            $data = $pendaftaran->with('angkatan')->orderBy('id', 'DESC')->first();
            $accessDate = date('Y-m-d');
            $accessDate = date('Y-m-d', strtotime($accessDate));
            $dateStart = date('Y-m-d', strtotime($data->tanggal_buka));
            $dateEnd = date('Y-m-d', strtotime($data->tanggal_tutup));

            if (($accessDate >= $dateStart) && ($accessDate <= $dateEnd)) {
                $message = "Pendaftaran Tahun " . $data->angkatan->nama . " Sudah Di Buka!";
                $data = ["open" => true, "judul" => $data->judul, "deskripsi" => $data->deskripsi];
            } else {
                $message = "Pendaftaran Tahun " . $data->angkatan->nama . " Sudah Di Tutup!";
                $data = ["open" => false, "judul" => $data->judul, "deskripsi" => $data->deskripsi];
            }
            return $this->sendResponse($data, $message);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), null, 500);
        }
    }
}
