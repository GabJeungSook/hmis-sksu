<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Patient;
use Livewire\Component;

class PatientList extends Component
{
    public $selected_type;

    public function render()
    {
        $patients = Patient::query();

        if ($this->selected_type !== "") {
            $patients = $patients->where('type', $this->selected_type);
        }

        return view('livewire.admin.reports.patient-list', [
            'patients' => $patients->get(),
        ]);
    }
}
