<?php

namespace App\Livewire\Pharmacy;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Medicine;
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

class ManageStock extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    public $record;


    public function mount($record)
    {
        $this->record = Medicine::find($record);
    }

    public function returnAction(): Action
    {
        return Action::make('return')
            ->icon('heroicon-o-arrow-left')
            ->requiresConfirmation()
            ->url(fn () => route('pharmacy.inventory'));
    }

    public function addStockAction(): Action
    {
        return CreateAction::make('addStock')
        ->model(Stock::class)
        ->label('Add Stock')
        ->icon('heroicon-o-plus-circle')
        ->color('primary')
        ->form([
            Hidden::make('medicine_id'),
            TextInput::make('quantity')
                ->required()
                ->numeric()
                ->maxLength(255),
            // ...
        ])->mutateFormDataUsing(function (array $data, array $arguments): array {
            $data['medicine_id'] = $arguments['id'];

            return $data;
        })
        ->after(function (array $data) {
            $this->record->update([
                'stock' => $this->record->stock + $data['quantity'],
            ]);
        })->disableCreateAnother();
    }

    public function render()
    {
        return view('livewire.pharmacy.manage-stock');
    }
}
