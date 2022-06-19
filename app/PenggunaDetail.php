<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaDetail extends Model
{
    protected $fillable = ['user_id', 'angkatan_id', 'alamat', 'jenis_kelamin', 'jurusan_id', 'nim', 'posisi_id', 'prestasi', 'role'];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

}
