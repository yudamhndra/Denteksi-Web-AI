<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pasien';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['tanggal_lahir'];

    public function dokter(){
        return $this->belongsTo('App\Models\Dokter', 'id_orangtua');
    }

}
    

