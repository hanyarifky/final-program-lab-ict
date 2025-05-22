<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $guarded = ['id'];

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke Lab
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    // Relasi ke JadwalDetail
    public function details()
    {
        return $this->hasMany(JadwalDetail::class, 'jadwal_id');
    }
}
