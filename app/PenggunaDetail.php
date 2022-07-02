<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaDetail extends Model
{
    protected $fillable = ['user_id', 'angkatan_id', 'posisi_id', 'alamat', 'jenis_kelamin', 'jurusan_id', 'nim', 'prestasi', 'role'];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

}
