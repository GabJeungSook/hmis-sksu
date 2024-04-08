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
    public $quantity;
    public $total_quantity;
    public $total_tax;
    public $sub_total;
    public $grand_total;
    public $transaction_number;

    public function mount(): void
    {
        $this->transaction_number = 'TRN-'.date('YmdHis');
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
                        $this->quantity += 1;
                        $this->selectedMedicines[$existingProductIndex]['tax'] += ($med->price * (12 / 100));
                        $this->selectedMedicines[$existingProductIndex]['sub_total'] += $med->price;
                        $this->sub_total =  array_sum(array_column($this->selectedMedicines, 'sub_total'));
                        $this->total_tax = array_sum(array_column($this->selectedMedicines, 'tax'));
                        $this->grand_total = $this->sub_total - $this->total_tax;
                    } else {
                        // Otherwise, add new product to the array
                        $this->selectedMedicines[] = [
                            'id' => $med->id,
                            'name' => $med->name,
                            'description' => $med->description,
                            'quantity' => 1,
                            'price' => $med->price,
                            'sub_total' => $med->price,
                            'tax' => ($med->price * (12 / 100))
                        ];
                        $this->quantity = 1;
                        $this->sub_total = array_sum(array_column($this->selectedMedicines, 'sub_total'));
                        $this->total_tax = array_sum(array_column($this->selectedMedicines, 'tax'));
                        $this->grand_total = $this->sub_total - $this->total_tax;
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

    public function editQuantityAction(): Action
    {
        return Action::make('editQuantity')
        ->icon('heroicon-m-pencil-square')
        ->iconButton()
        ->color('primary')
        ->form([
            TextInput::make('quantity')
            ->required()
            ->numeric()
            ->minValue(1)
            ->maxValue(100)
        ])
        ->action(function (array $arguments, array $data) {
                $existingProductIndex = $this->findProductIndex($arguments['id']);
                $this->selectedMedicines[$existingProductIndex]['quantity'] = $data['quantity'];
                $this->selectedMedicines[$existingProductIndex]['sub_total'] = $this->selectedMedicines[$existingProductIndex]['price'] * $data['quantity'];
                $this->selectedMedicines[$existingProductIndex]['tax'] = ($this->selectedMedicines[$existingProductIndex]['price'] * (12 / 100));
                $this->sub_total =  array_sum(array_column($this->selectedMedicines, 'sub_total'));
                $this->total_tax = array_sum(array_column($this->selectedMedicines, 'tax'));
                $this->grand_total = $this->sub_total - $this->total_tax;
        })
        ->requiresConfirmation();
    }

    public function saveTransactionAction(): Action
    {
        return Action::make('saveTransaction')
        ->label('Payment')
        ->action(function () {
            //save transaction
            //save transaction details
            //update stock
            //clear all data
            $this->selectedMedicines = [];
            $this->quantity = 0;
            $this->total_tax = 0;
            $this->sub_total = 0;
            $this->grand_total = 0;
            $this->form->fill();
        })
        ->extraAttributes([
            'class' => 'w-full',
        ])
        ->requiresConfirmation();
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
