<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table= 'kelurahan';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];


    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }
    public function sekolah(){
        return $this->hasMany('App\Models\Sekolah', 'id_kelurahan');
    }
}
