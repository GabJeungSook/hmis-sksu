<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\User;
use App\Models\PatientInfo;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;

class AddInformation extends Component implements HasForms
{
    use InteractsWithForms;
    public $user;
    public ?array $data = [];

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                    Hidden::make('user_id')->default($this->user->id),
                    TextInput::make('first_name')->required(),
                    TextInput::make('middle_name'),
                    TextInput::make('last_name')->required(),
                    ]),
                    Textarea::make('full_address')->required(),
                    Grid::make(3)
                    ->schema([
                        DatePicker::make('birthday')->required()->native(false),
                        Select::make('gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female'
                        ])->required(),
                        Select::make('tribe')
                        ->options([
                            'Aeta' => 'Aeta',
                            'Agta' => 'Agta',
                            'Blaan' => 'Blaan',
                            'Bontoc' => 'Bontoc',
                            'Buhid' => 'Buhid',
                            'Cagayan' => 'Cagayan',
                            'Calamian' => 'Calamian',
                            'Cebuano' => 'Cebuano',
                            'Cuyonon' => 'Cuyonon',
                            'Gaddang' => 'Gaddang',
                            'Ifugao' => 'Ifugao',
                            'Ibanag' => 'Ibanag',
                            'Ibaloi' => 'Ibaloi',
                            'Ilocano' => 'Ilocano',
                            'Isnag' => 'Isnag',
                            'Kankanaey' => 'Kankanaey',
                            'Kinaray-a' => 'Kinaray-a',
                            'Kuyonon' => 'Kuyonon',
                            'Lumad' => 'Lumad',
                            'Mangyan' => 'Mangyan',
                            'Manobo' => 'Manobo',
                            'Maranao' => 'Maranao',
                            'Negrito' => 'Negrito',
                            'Palawano' => 'Palawano',
                            'Pangasinense' => 'Pangasinense',
                            'Sama' => 'Sama',
                            'Subanon' => 'Subanon',
                            'Tausug' => 'Tausug',
                            'Tingguian' => 'Tingguian',
                            'T\'boli' => 'T\'boli',
                            'Yakan' => 'Yakan',
                            'Zambal' => 'Zambal',
                            'Others' => 'Others'
                        ])->required()
                    ])

            ])->statePath('data')
            ->model(PatientInfo::class);
    }

    public function submitInfo()
    {
        $patient = PatientInfo::create($this->form->getState());

        Notification::make()
                ->title('Success')
                ->body('Patient Information successfully added.')
                ->success()
                ->send();

        return redirect()->route('student.dashboard');
    }

    public function render()
    {
        return view('livewire.student.add-information');
    }
}
