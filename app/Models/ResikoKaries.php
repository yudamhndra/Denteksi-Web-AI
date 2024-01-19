<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResikoKaries extends Model
{
    use HasFactory;
    protected $table = 'resiko_karies';
    protected $guarded = ['created_at', 'updated_at'];


}
