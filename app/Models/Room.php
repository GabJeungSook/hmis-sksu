<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

}
