<?php

namespace App\Livewire\Doctor;

use App\Models\Patient;
use Livewire\Component;
use Filament\Support\RawJs;
use Filament\Actions\Action;
use App\Models\LaboratoryTest;
use App\Models\LaboratoryResult;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class ManageLaboratory extends Component implements HasForms, HasActions
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
            ->url(fn () => route('doctor.laboratories'));
    }

    public function addTestAction(): Action
    {
        return CreateAction::make('addTest')
        ->model(LaboratoryTest::class)
        ->label('Add Test')
        ->icon('heroicon-o-plus-circle')
        ->color('primary')
        ->form([
            Hidden::make('patient_id')
                ->default($this->record->id),
            Textarea::make('test')
                ->required()
                ->maxLength(255),
            TextInput::make('amount')
                ->label('Amount')
                ->numeric()
                ->autofocus()
                ->prefix('₱')
                ->mask(RawJs::make('$money($input)'))
                ->stripCharacters(',')
                ->required(),
            // ...
        ]);
    }

    public function addResultAction(): Action
    {
        return CreateAction::make('addResult')
        ->model(LaboratoryResult::class)
        ->label('Add Result')
        ->icon('heroicon-o-plus-circle')
        ->color('primary')
        ->form([
            Hidden::make('laboratory_test_id'),
            Textarea::make('result')
                ->required()
                ->maxLength(255),
            // ...
        ])->mutateFormDataUsing(function (array $data, array $arguments): array {
            $data['laboratory_test_id'] = $arguments['id'];

            return $data;
        })->disableCreateAnother();
    }


    public function render()
    {
        return view('livewire.doctor.manage-laboratory');
    }
}
