<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanTelinga extends Model
{
    use HasFactory;
    
    protected $table = 'pemeriksaan_telinga';

    protected $guarded = ['created_at', 'updated_at'];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
}
