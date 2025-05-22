<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = "mata_kuliah";
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return "kode_mata_kuliah";
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, "matkul_id");
    }
}
