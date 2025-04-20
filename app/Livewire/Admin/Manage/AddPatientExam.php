<?php

namespace App\Livewire\Admin\Manage;

use Livewire\Component;
use App\Models\PatientVitals;
use App\Models\PatientInfo;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;

class AddPatientExam extends Component implements HasForms 
{
    use InteractsWithForms;

    public ?array $data = [];
    public $qrCode;
    public $patient = null;
    public $isValid = false;

    public function readQR()
    {
        $this->patient = PatientInfo::find($this->qrCode);

        if (!$this->patient) {
            Notification::make()
            ->title('Not Found')
            ->body('No patient were found with this QR Code.')
            ->danger()
            ->send();
            $this->qrCode = null;
        }elseif($this->patient->patientVitals()->exists()){
            Notification::make()
            ->title('Patient Exists')
            ->body('A patient with this QR Code already has a result.')
            ->danger()
            ->send();
            $this->qrCode = null;
        }else{
            $this->isValid = true;
        }
        $this->qrCode = null;
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('temperature')
                        ->label('Temperature (°C)')
                        ->numeric()
                        ->inputMode('decimal')
                        ->minValue(1)
                        ->maxValue(100)
                        ->required()
                        ->maxLength(255),
                    TextInput::make('blood_pressure')
                        ->label('Blood Pressure')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('heart_rate')
                        ->label('Heart Rate')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('respiratory_rate')
                        ->label('Respiratory Rate')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('initial_diagnosis')->required(),
                // Grid::make(3)
                //     ->schema([
                //     TextInput::make('first_name')->required(),
                //     TextInput::make('middle_name'),
                //     TextInput::make('last_name')->required(),
                //     ]),
                //     Textarea::make('full_address')->required(),
                //     Grid::make(2)
                //     ->schema([
                //         DatePicker::make('birthday')->required()->native(false),
                //         Select::make('gender')
                //         ->options([
                //             'male' => 'Male',
                //             'female' => 'Female'
                //         ])->required()
                //     ])

            ])->statePath('data')
            ->model(PatientVitals::class);
    }

    public function submitPatientExam()
    {
        $exam = PatientVitals::create([
            'patient_id' => $this->patient->id,
            'temperature' => $this->form->getState()["temperature"],
            'blood_pressure' => $this->form->getState()["blood_pressure"],
            'heart_rate' => $this->form->getState()["heart_rate"],
            'respiratory_rate' => $this->form->getState()["respiratory_rate"],
            'initial_diagnosis' => $this->form->getState()["initial_diagnosis"],
        ]); 

        Notification::make()
        ->title('Success')
        ->body('Patient examination successfully added.')
        ->success()
        ->send();

        return redirect()->route('doctor.vitals');
    }

    public function render()
    {
        return view('livewire.admin.manage.add-patient-exam');
    }
}
