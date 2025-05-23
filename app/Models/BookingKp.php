<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingKp extends Model
{
    protected $table = 'booking_kp';

    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke Lab
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
