<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vital()
    {
        return $this->hasOne(PatientVitals::class);
    }

    public function laboratoryTests()
    {
        return $this->hasMany(LaboratoryTest::class);
    }

}
