<?php

namespace App\Livewire\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Models\PatientInfo;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $doctor_count;
    public $patient_count;
    public $room_count;
    public $in_patient;
    public $out_patient;
    public $discharged_patient;
    public $cases;
    public $cases_get;
    public $cases_labels = [];
    public $cases_counts = [];
    public $labels_string;
    public $examined;
    public $genders;
    public $genderCounts = [];
    public $tribes;
    public $tribeCounts = [];
    public $ages;
    public $ageCounts = [];
    public $colors = [];

    public function mount()
    {

        $this->genders = PatientInfo::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get();

        // Tribe group
        $this->tribes = PatientInfo::select('tribe', DB::raw('count(*) as total'))
            ->groupBy('tribe')
            ->get();

        // Age group
        $this->ages = PatientInfo::select(DB::raw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age'), DB::raw('count(*) as total'))
            ->groupBy('age')
            ->orderBy('age')
            ->get();

        // Assign a unique color to each label
        $allLabels = collect($this->genders)->pluck('gender')
            ->merge($this->tribes->pluck('tribe'))
            ->merge($this->ages->pluck('age'));

        foreach ($allLabels as $label) {
            $this->colors[(string) $label] = '#' . substr(md5($label), 0, 6); // hex from hash
        }


        $this->doctor_count = User::where('role_id', 2)->count();
        $this->patient_count = PatientInfo::count();
        $this->in_patient = Patient::where('type', 'In-Patient')->count();
        $this->out_patient = Patient::where('type', 'Out-Patient')->count();
        $this->discharged_patient = Patient::where('type', 'Discharged')->count();
        $this->cases = PatientInfo::whereHas('healthCases')->count();
        $this->examined = PatientInfo::whereHas('patientVitals')->count();
        $this->cases_get = Patient::whereNotNull('initial_diagnosis')->get();
        $diagnosis_counts = [];
        foreach ($this->cases_get as $item) {
            $formatted_diagnosis = trim(strip_tags($item->initial_diagnosis));
            $item_count = Patient::where('initial_diagnosis', $item->initial_diagnosis)->count();
            $formatted_counts = trim(strip_tags($item_count));
            // Check if the diagnosis already exists in the count array
            if (isset($diagnosis_counts[$formatted_diagnosis])) {
                $diagnosis_counts[$formatted_diagnosis]++; // Increment the count for existing diagnosis
            } else {
                $diagnosis_counts[$formatted_diagnosis] = 1; // Add the diagnosis and initialize its count to 1
            }

            $this->cases_labels[] = $formatted_diagnosis;
            $this->cases_counts[] = $formatted_counts;
        }


        // dd($this->cases_counts);
        $this->labels_string = json_encode($this->cases_labels);

        $this->room_count = Room::all()->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
