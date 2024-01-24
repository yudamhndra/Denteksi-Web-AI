<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanGigi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "pemeriksaan_gigi";

    protected $guarded = ['created_at', 'updated_at'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
    public function resikoKaries()
    {
        return $this->hasOne('App\Models\ResikoKaries', 'id_pemeriksaan_gigi');
    }
    public function skriningOdontogram()
    {
        return $this->hasMany('App\Models\SkriningOdontogram', 'id_pemeriksaan');
    }
    public function skriningIndeks()
    {
        return $this->hasOne('App\Models\SkriningIndeks', 'id_pemeriksaan');
    }
    public function kelas(){
        return $this->belongsTo('App\Models\Kelas', 'id_kelas');
    }
    public function sekolah(){
        return $this->belongsTo('App\Models\Sekolah', 'id_sekolah',"id");
    }
    public function skriningIndeksMany()
    {
        return $this->belongsTo('App\Models\SkriningIndeks', 'id_pemeriksaan');
    }
}
