<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi';
    protected $guarded = ['created_at','updated_at'];
    public $timestamps = true;

    public function poliHari()
    {
        return $this->belongsTo('App\Models\PoliHari', 'poli_hari_id', 'id');
    }

    public function dokterSesi()
    {
        return $this->hasMany('App\Models\DokterSesi', 'sesi_id', 'id');
    }
}
