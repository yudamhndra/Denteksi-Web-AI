<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliHari extends Model
{
    use HasFactory;

    protected $table = 'poli_hari';
    protected $guarded = ['created_at','updated_at'];
    public $timestamps = true;

    public function hari()
    {
        return $this->belongsTo('App\Models\Hari', 'hari_id', 'id');
    }
    public function poli()
    {
        return $this->belongsTo('App\Models\Poli', 'poli_id', 'id');
    }
    public function sesi()
    {
        return $this->hasMany('App\Models\Sesi', 'poli_hari_id', 'id');
    }
}
