<?php

namespace App\Livewire\Doctor;

use App\Models\Bed;
use App\Models\Room;
use App\Models\Patient;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Notifications\Notification;

class ViewMedicalRecord extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;

    public function mount($record)
    {
        $this->record = Patient::find($record);
    }

    public function returnAction(): Action
    {
        return Action::make('return')
            ->icon('heroicon-o-arrow-left')
            ->requiresConfirmation()
            ->url(fn () => route('doctor.medical-records'));
    }

    public function assignRoomAction(): Action
    {
        return Action::make('assignRoom')
            ->icon('heroicon-o-inbox-arrow-down')
            ->requiresConfirmation()
            ->form([
              Select::make('room_id')
              ->live()
              ->label('Room')
              ->options(Room::all()->pluck('name', 'id')),
              Select::make('bed_id')
              ->label('Bed')
              ->options(fn (Get $get) => Bed::where('room_id', $get('room_id'))->pluck('name', 'id'))
            ])
            ->action(function (array $data) {
                $patient = Patient::find($this->record->id);
                $patient->update([
                    'bed_id' => $data['bed_id'],
                ]);

                Notification::make()
                ->title('Room Assigned')
                ->success()
                ->send();
            });
    }

    public function render()
    {
        return view('livewire.doctor.view-medical-record');
    }
}
