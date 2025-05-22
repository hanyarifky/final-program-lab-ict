<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDetail extends Model
{
    protected $table = 'jadwal_detail';

    protected $guarded = ['id'];

    // Relasi ke Jadwal (induk)
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}
