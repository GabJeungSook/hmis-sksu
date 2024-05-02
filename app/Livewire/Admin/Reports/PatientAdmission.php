<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Patient;
use Livewire\Component;

class PatientAdmission extends Component
{
    public function render()
    {
        return view('livewire.admin.reports.patient-admission', [
            'patients' => Patient::where('type', 'In-Patient')->get()
        ]);
    }
}
