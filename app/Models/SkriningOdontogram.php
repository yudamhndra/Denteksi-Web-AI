<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningOdontogram extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pemeriksaan',
        'aksi',
        'posisi',
    ];
}
