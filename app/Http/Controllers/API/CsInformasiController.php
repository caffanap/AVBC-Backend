<?php

namespace App\Http\Controllers\API;

use App\Angkatan;
use App\Faq;
use App\Info;
use App\Jurusan;
use App\Pendaftaran;
use App\PenggunaDetail;
use App\Posisi;
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
                $data = $info->where('type', 'info')->where('angkatan_id', $user->pengguna_detail->angkatan_id)->orWhere('angkatan_id', null)->orderBy('id', 'DESC')->get();
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

    public function kegiatan(Info $info)
    {
        $authenticated_user = Auth::user();
        if ($authenticated_user) {
            try {
                $user = User::with('pengguna_detail')->where('id', $authenticated_user->id)->first();
                $data = $info->where('type', 'kegiatan')->where('angkatan_id', $user->pengguna_detail->angkatan_id)->orWhere('angkatan_id', null)->orderBy('id', 'DESC')->get();
                return $this->sendResponse($data, 'Berhasil menampilkan list kegiatan');
            } catch (\Exception $e) {
                return $this->sendError($e->errorInfo[2], null, 500);
            }
        } else {
            try {
                $data = $info->where('angkatan_id', null)->get();
                return $this->sendResponse($data, 'Berhasil menampilkan list kegiatan');
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
                $data = $angkatan->with(['pengguna_detail.user' => function($query) {
                    $query->orderBy('name', 'ASC');
                }])->where('id', $request->angkatan)->first();
            } else {
                $data = $angkatan->with('pengguna_detail.user')->get();
            }
            return $this->sendResponse($data, 'Berhasil menampilkan list teman angkatan');
        } catch (\Exception $e) {
            return $this->sendError($e->errorInfo[2], null, 500);
        }
    }

    public function groupWa(User $user)
    {
        try {
            $authenticated_user = Auth::user();
            $data = $user->with('pengguna_detail.angkatan.pendaftaran')->where('id', $authenticated_user->id)->first();
            $data = [
                'link' => $data->pengguna_detail->angkatan->pendaftaran->link_wa
            ];
            return $this->sendResponse($data, "Berhasil menampilkan grup WA");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), null, 500);
        }
    }

    public function jurusan(Jurusan $jurusan)
    {
        return $this->sendResponse($jurusan->all(), "Berhasil menampilkan jurusan");
    }

    public function posisi(Posisi $posisi)
    {
        return $this->sendResponse($posisi->all(), "Berhasil menampilkan posisi");
    }

    public function jabatan(PenggunaDetail $penggunaDetail)
    {
        $data['ketua'] = $penggunaDetail->with(['user', 'jurusan', 'posisi', 'angkatan'])->where('role', 'ketua')->first();
        $data['wakil'] = $penggunaDetail->with(['user', 'jurusan', 'posisi', 'angkatan'])->where('role', 'wakil')->first();
        $data['sekretaris'] = $penggunaDetail->with(['user', 'jurusan', 'posisi', 'angkatan'])->where('role', 'sekretaris')->first();
        $data['bendahara'] = $penggunaDetail->with(['user', 'jurusan', 'posisi', 'angkatan'])->where('role', 'bendahara')->first();

        return $this->sendResponse($data, "Berhasil menampilkan jabatan");
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
                $data = ["open" => true, "judul" => $data->judul, "deskripsi" => $data->deskripsi, "angkatan_id" => $data->angkatan->id];
            } else {
                if ($accessDate >= $dateStart) {
                    $message = "Pendaftaran Tahun " . $data->angkatan->nama . " Sudah Di Tutup!";
                }elseif ($accessDate <= $dateEnd) {
                    $message = "Pendaftaran Tahun " . $data->angkatan->nama . " Belum Di Buka!";
                }
                $data = ["open" => false, "judul" => $data->judul];
            }
            return $this->sendResponse($data, $message);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), null, 500);
        }
    }
}
