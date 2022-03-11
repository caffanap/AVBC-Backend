<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaDetail extends Model
{
    protected $fillable = ['user_id', 'angkatan_id', 'alamat', 'jenis_kelamin', 'jurusan_id', 'nim', 'posisi_id', 'prestasi', 'foto', 'alumni'];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
