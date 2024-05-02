<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use App\Models\PatientBill;

class PatientBilling extends Component
{
    public function render()
    {
        return view('livewire.admin.reports.patient-billing', [
            'billing' => PatientBill::all()
        ]);
    }
}
