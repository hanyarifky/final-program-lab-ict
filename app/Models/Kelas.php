<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public function getRouteKeyName()
    {
        return "kode_kelas";
    }

    protected $table = "ruangan";
    protected $guarded = ["id"];

}
