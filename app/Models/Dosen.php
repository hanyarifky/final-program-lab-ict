<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Dosen extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $table = 'dosen';
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'nip';
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, "dosen_id");
    }
}
