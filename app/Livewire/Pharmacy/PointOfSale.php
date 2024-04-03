<?php

namespace App\Livewire\Pharmacy;

use Livewire\Component;
use App\Models\Medicine;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class PointOfSale extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    public ?array $data = [];
    public $selectedMedicines = [];
    public $total_quantity;
    public $sub_total;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('medicine')
                    ->label('Search Medicine')
                    ->searchable()
                    ->options(Medicine::where('stock' ,'>', 0)->pluck('name', 'id'))
                    ->required(),
                // ...
            ])
            ->statePath('data');
    }


    public function addItemAction(): Action
    {
        return Action::make('addItem')
            ->label('Add Item')
            ->action(function () {
                $med = Medicine::where('id', $this->data['medicine'])->first();
                if ($med) {
                    $existingProductIndex = $this->findProductIndex($med->id);
                    if ($existingProductIndex !== false) {
                        // If product already exists, increment quantity
                        $this->selectedMedicines[$existingProductIndex]['quantity'] += 1;
                        $this->selectedMedicines[$existingProductIndex]['price'] = $this->selectedMedicines[$existingProductIndex]['quantity'] * $med->price;
                        $this->sub_total = $this->selectedMedicines[$existingProductIndex]['price'] * $this->selectedMedicines[$existingProductIndex]['quantity'];
                    } else {
                        // Otherwise, add new product to the array
                        $this->selectedMedicines[] = [
                            'id' => $med->id,
                            'name' => $med->name,
                            'description' => $med->description,
                            'quantity' => 1,
                            'price' => $med->price,
                        ];
                        $this->sub_total = $med->price;
                    }
                }



                $this->form->fill();

            });
    }

    public function removeItemAction(): Action
    {
        return Action::make('removeItem')
        ->icon('heroicon-o-trash')
        ->iconButton()
        ->color('danger')
        ->requiresConfirmation()
        ->action(function (array $arguments) {
            //remove item in $this->selectedMedicines

            $this->selectedMedicines = array_values(array_filter($this->selectedMedicines, function ($product) use ($arguments) {
                return $product['id'] !== $arguments['id'];
            }));

        });
    }

    public function findProductIndex($productId)
    {
        foreach ($this->selectedMedicines as $index => $product) {
            if ($product['id'] === $productId) {
                return $index;
            }
        }

        return false;
    }

    public function render()
    {
        return view('livewire.pharmacy.point-of-sale');
    }
}
