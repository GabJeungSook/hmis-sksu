<?php

namespace App\Livewire\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;

class Dashboard extends Component
{
    public $doctor_count;
    public $patient_count;
    public $room_count;

    public function mount()
    {
        $this->doctor_count = User::where('role_id', 2)->count();
        $this->patient_count = Patient::whereNotIn('type', ['Discharged'])->count();
        $this->room_count = Room::all()->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
