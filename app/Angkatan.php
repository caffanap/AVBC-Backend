<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    protected $fillable = ['nama'];

    public function pengguna_detail()
    {
        return $this->hasMany(PenggunaDetail::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
    //
}
