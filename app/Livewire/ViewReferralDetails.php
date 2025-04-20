<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PatientInfo;
use App\Models\Referral as ReferralModel;

class ViewReferralDetails extends Component
{
    public $record;
    public $referral;

    public function mount($record, $id)
    {
        $this->record = PatientInfo::find($record);
        $this->referral = ReferralModel::find($id);
    }

    public function render()
    {
        return view('livewire.view-referral-details');
    }
}
