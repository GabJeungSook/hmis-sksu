<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PatientInfo;

class ViewHealthRecord extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = PatientInfo::find($record);
    }
    
    public function render()
    {
        return view('livewire.view-health-record');
    }
}
