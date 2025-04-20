<?php

namespace App\Livewire\Admin\Manage;

use Livewire\Component;
use App\Models\HealthRecord;
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

class AddHealthRecord extends Component implements HasForms 
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
                    Textarea::make('health_record')
                        ->label('Health Record')->required(),
                    DatePicker::make('date_recorded')->native(false)->required()
                        
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
            ->model(HealthRecord::class);
    }

    public function submitHealthRecord()
    {
        $record = HealthRecord::create([
            'patient_infos_id' => $this->patient->id,
            'health_record' => $this->form->getState()["health_record"],
            'date_recorded' => $this->form->getState()["date_recorded"],
        ]); 

        Notification::make()
        ->title('Success')
        ->body('Patient health record successfully added.')
        ->success()
        ->send();

        return redirect()->route('admin.health_records');
    }

    public function render()
    {
        return view('livewire.admin.manage.add-health-record');
    }
}
