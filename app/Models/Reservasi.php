<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $guarded = ['created_at','updated_at'];
    public $timestamps = true;

    public function anak(){
        return $this->belongsTo('App\Models\Anak', 'id_anak');
    }

    public function poli(){
        return $this->belongsTo('App\Models\Poli', 'poli_id', 'id');
    }
}
