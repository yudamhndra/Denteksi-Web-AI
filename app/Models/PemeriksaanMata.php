<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanMata extends Model
{
    use HasFactory;

    protected $table="pemeriksaan_mata";
    protected $guarded = ['created_at', 'updated_at'];

    public function anak(){
        return $this->belongsTo('App\Models\Anak', 'id_anak');
    }
    
    
}
