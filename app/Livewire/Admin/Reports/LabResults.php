<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use App\Models\Patient;

class LabResults extends Component
{
    public function render()
    {
        return view('livewire.admin.reports.lab-results', [
            'labResults' => Patient::whereHas('laboratoryTests')->get()
        ]);
    }
}
