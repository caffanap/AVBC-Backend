<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = ['angkatan_id', 'judul', 'deskripsi', 'tanggal_buka', 'tanggal_tutup', 'link_wa'];
    //
    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }
}
