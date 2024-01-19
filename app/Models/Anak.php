<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anak extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'anak';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['tanggal_lahir'];

    public function orangtua(){
        return $this->belongsTo('App\Models\Orangtua', 'id_orangtua');
    }
    public function sekolah(){
        return $this->belongsTo('App\Models\Sekolah', 'id_sekolah');
    }
    public function kelas(){
        return $this->belongsTo('App\Models\Kelas', 'id_kelas');
    }
    public function pemeriksaanFisik(){
        return $this->hasOne('App\Models\PemeriksaanFisik', 'id_anak')->latest();
    }
    public function pemeriksaanTelinga(){
        return $this->hasOne('App\Models\PemeriksaanTelinga', 'id_anak')->latest();
    }
    public function pemeriksaanMata(){
        return $this->hasOne('App\Models\PemeriksaanMata', 'id_anak')->latest();
    }

}
    

