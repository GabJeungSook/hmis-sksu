<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;

class PatientList extends Component
{
    public function render()
    {
        return view('livewire.admin.reports.patient-list', [
            'patients' => \App\Models\Patient::all()
        ]);
    }
}
