<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = ['angkatan_id', 'judul', 'deskripsi', 'lokasi', 'jadwal', 'ketentuan', 'maps', 'type'];
    //
    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

}
