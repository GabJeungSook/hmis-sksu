<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryResult extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function laboratoryTest()
    {
        return $this->belongsTo(LaboratoryTest::class);
    }
}
