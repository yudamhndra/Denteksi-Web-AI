<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $table="reminders";
    protected $guarded = ['created_at', 'updated_at'];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
    public function orangtua()
    {
        return $this->belongsTo(Orangtua::class, 'id_orangtua');
    }
}
