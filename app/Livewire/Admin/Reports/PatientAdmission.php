<?php

namespace App\Livewire\Admin\Reports;

use App\Models\PatientInfo;
use Livewire\Component;

class PatientAdmission extends Component
{
    public function render()
    {
        return view('livewire.admin.reports.patient-admission', [
            'patients' => PatientInfo::whereHas('healthCases')->get()
        ]);
    }
}
