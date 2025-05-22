<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{

    protected $table = "kelas";
    protected $guarded = ["id"];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, "dosen_id");
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
}
