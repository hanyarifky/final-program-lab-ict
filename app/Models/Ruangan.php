<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    public function getRouteKeyName()
    {
        return "kode_ruangan";
    }

    protected $table = "ruangan";
    protected $guarded = ["id"];
}
