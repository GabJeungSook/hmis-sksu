<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Referral;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patientVitals()
    {
        return $this->hasOne(PatientVitals::class, 'patient_id', 'id');
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'patient_infos_id', 'id');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'patient_infos_id', 'id');
    }

    public function healthCases()
    {
        return $this->hasMany(HealthCase::class, 'patient_infos_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age;
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
