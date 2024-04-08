<?php

namespace App\Livewire\Pharmacy;

use Livewire\Component;
use App\Models\Medicine;
use Filament\Forms\Form;
use App\Models\Transaction;
use Filament\Support\RawJs;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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
        ->form([
            TextInput::make('payment_amount')
            ->label('Amount')
            ->numeric()
            ->autofocus()
            ->prefix('₱')
            ->mask(RawJs::make('$money($input)'))
            ->stripCharacters(',')
            ->rules('numeric|min:'.$this->grand_total)
            ->required(),

        ])
        ->action(function (array $data) {
            //save transaction
            DB::beginTransaction();
            $transaction = Transaction::create([
                'transaction_number' => $this->transaction_number,
                'quantity' => array_sum(array_column($this->selectedMedicines, 'quantity')),
                'sub_total' => $this->sub_total,
                'tax' => $this->total_tax,
                'grand_total' => $this->grand_total,
                'amount_paid' => $data['payment_amount'],
                'change' => $data['payment_amount'] - $this->grand_total,
            ]);

            //save transaction details
            foreach ($this->selectedMedicines as $key => $product) {
                $transaction->transaction_items()->create([
                    'medicine_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'sub_total' => $product['sub_total'],
                ]);
            }

            //update stock
            foreach ($this->selectedMedicines as $key => $product) {
                $product = Medicine::find($product['id']);
                $updated_quantity = $product->stocks()->where('quantity', '>', 0)->first()->quantity - $product['quantity'];
                $product->stocks()->where('quantity', '>', 0)->first()->update(['quantity' => $updated_quantity]);
            }
            DB::commit();

            Notification::make()
            ->title('Payment Successful')
            ->body('Transaction has been saved successfully.')
            ->success()
            ->send();
            //reload page
            return redirect()->route('pharmacy.pos');

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
