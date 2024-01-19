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
    protected $fillable=[
        'id_users',
        'nik',
        'id_kecamatan',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'no_str'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }
    public function dokterSesi()
    {
        return $this->hasMany('App\Models\DokterSesi', 'dokter_id', 'id');
    }
}
