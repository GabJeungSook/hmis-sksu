<?php

namespace App\Livewire\Admin\Manage;

use App\Models\Bed;
use App\Models\Room;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class ManageBed extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    public $record;

    public function mount(Room $record)
    {
        $this->record = $record;
    }

    public function returnAction(): Action
    {
        return Action::make('return')
            ->icon('heroicon-o-arrow-left')
            ->requiresConfirmation()
            ->url(fn () => route('admin.rooms-and-beds'));
    }

    public function addBedAction(): Action
    {
        return CreateAction::make('addBed')
            ->model(Bed::class)
            ->label('Add Bed')
            ->icon('heroicon-o-plus-circle')
            ->color('primary')
            ->link()
            ->form([
                Hidden::make('room_id')
                    ->default($this->record->id),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // ...
            ]);
    }

    public function updateBedAction(): Action
    {
        return Action::make('updateBed')
            ->label('Edit')
            ->link()
            ->icon('heroicon-m-pencil-square')
            ->color('success')
            ->requiresConfirmation()
            ->mountUsing(function (Form $form, array $arguments) {
                $bed = Bed::find($arguments['id']);
                $form->fill([
                    'name' => $bed->name,
                ]);
            })
            ->form([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])->action(function (array $arguments, array $data) {
                $bed = Bed::find($arguments['id']);
                $bed->name = $data['name'];
                $bed->save();
            });
    }


    public function deleteBedAction(): Action
    {
        return Action::make('deleteBed')
            ->label('Delete')
            ->link()
            ->icon('heroicon-o-trash')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                $bed = Bed::find($arguments['id']);
                $bed->delete();
            });
    }

    public function render()
    {
        return view('livewire.admin.manage.manage-bed');
    }
}
