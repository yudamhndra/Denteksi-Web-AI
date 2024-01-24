<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dokter';
    protected $guarded = ['created_at', 'updated_at'];



    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }
    public function kelurahan(){
        return $this->belongsTo('App\Models\Kelurahan', 'id_kelurahan');
    }
    public function sekolah(){
        return $this->belongsTo('App\Models\Sekolah', 'id_sekolah');
    }
    public function kelas(){
        return $this->belongsTo('App\Models\Kelas', 'id_kelas');
    }
    public function pasien(){
        return $this->hasMany('App\Models\Pasien', 'id_dokter');
    }
    
}
