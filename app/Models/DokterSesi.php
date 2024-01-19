<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterSesi extends Model
{
    use HasFactory;

    protected $table = 'dokter_sesi';
    protected $guarded = ['created_at','updated_at'];
    public $timestamps = true;

    public function sesi()
    {
        return $this->belongsTo('App\Models\Sesi', 'sesi_id', 'id');
    }
    public function dokter()
    {
        return $this->belongsTo('App\Models\Dokter', 'dokter_id', 'id');
    }
}
