<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Medicine;
use Livewire\Component;

class MedicineList extends Component
{
    public function render()
    {
        return view('livewire.admin.reports.medicine-list', [
            'medicines' => Medicine::all()
        ]);
    }
}
