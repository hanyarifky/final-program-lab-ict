<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = "ruangan";
    protected $guarded = ["id"];

    public function getRouteKeyName()
    {
        return "kode_ruangan";
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'ruangan_id');
    }
}
