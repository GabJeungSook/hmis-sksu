<?php

namespace App\Livewire\Admin\Manage;


use Livewire\Component;
use App\Models\Referral;
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

class AddReferral extends Component implements HasForms 
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('hospital_name')
                        ->label('Hospital Name')->required(),
                    TextInput::make('doctor_name')
                    ->label('Doctor Name')->required(),
                    Textarea::make('diagnosis')->required()
                        
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
            ->model(Referral::class);
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function submitReferral()
    {
        $record = Referral::create([
            'patient_infos_id' => $this->patient->id,
            'hospital_name' => $this->form->getState()["hospital_name"],
            'doctor_name' => $this->form->getState()["doctor_name"],
            'diagnosis' => $this->form->getState()["diagnosis"],
        ]); 

        Notification::make()
        ->title('Success')
        ->body('Referral successfully added.')
        ->success()
        ->send();

        return redirect()->route('admin.referrals');
    }

    public function render()
    {
        return view('livewire.admin.manage.add-referral');
    }
}
