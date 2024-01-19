<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';
    protected $guarded = ['created_at','updated_at'];
    public $timestamps = true;

    public function poliHari()
    {
        return $this->hasMany('App\Models\PoliHari', 'poli_id', 'id');
    }
    public function hari()
    {
        return $this->belongsToMany('App\Models\Hari', 'poli_hari');
    }
    public function reservasi()
    {
        return $this->hasMany('App\Models\Reservasi', 'poli_id', 'id');
    }
}
