<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningIndeks extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pemeriksaan',
        'def_d',
        'def_e',
        'def_f',
        'dmf_d',
        'dmf_e',
        'dmf_f',
        'diagnosa',
        'rekomendasi',
        'reservasi'
    ];
    public function pemeriksaanGigi()
    {
        return $this->hasOne('App\Models\PemeriksaanGigi', 'id','id_pemeriksaan');
    }
}
