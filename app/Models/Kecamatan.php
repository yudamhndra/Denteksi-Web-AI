<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table= 'kecamatan';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
}
