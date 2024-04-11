<?php

namespace App\Livewire\Cashier;

use App\Models\Patient;
use Livewire\Component;
use Filament\Support\RawJs;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class BillOut extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;
    public $grand_total;

    public function mount($record)
    {
        $this->record = Patient::find($record);
        $total = 0;
        if ($this->record->type === 'In-Patient' && $this->record->bed) {
            $total += $this->record->bed->room->amount;
        }else{
            $total = 0;
        }
        if ($this->record->laboratoryTests) {
            foreach ($this->record->laboratoryTests as $test) {
                $total += $test->amount;
            }
        }

        $this->grand_total = $total;
    }

    public function payBillAction(): Action
    {
        return Action::make('payBill')
        ->label('Pay Bill')
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
            $bill = $this->record->patientBill()->create([
                'total' => $this->grand_total,
                'amount_paid' => $data['payment_amount'],
                'change' => $data['payment_amount'] - $this->grand_total,
            ]);

            $this->record->update(['type' => 'Discharged']);
            // $transaction = Transaction::create([
            //     'transaction_number' => $this->transaction_number,
            //     'quantity' => array_sum(array_column($this->selectedMedicines, 'quantity')),
            //     'sub_total' => $this->sub_total,
            //     'tax' => $this->total_tax,
            //     'grand_total' => $this->grand_total,
            //     'amount_paid' => $data['payment_amount'],
            //     'change' => $data['payment_amount'] - $this->grand_total,
            // ]);

            // //save transaction details
            // foreach ($this->selectedMedicines as $key => $product) {
            //     $transaction->transaction_items()->create([
            //         'medicine_id' => $product['id'],
            //         'quantity' => $product['quantity'],
            //         'price' => $product['price'],
            //         'sub_total' => $product['sub_total'],
            //     ]);
            // }

            // //update stock
            // foreach ($this->selectedMedicines as $key => $product) {
            //     $product = Medicine::find($product['id']);
            //     $updated_quantity = $product->stocks()->where('quantity', '>', 0)->first()->quantity - $product['quantity'];
            //     $product->stocks()->where('quantity', '>', 0)->first()->update(['quantity' => $updated_quantity]);
            // }
            DB::commit();

            Notification::make()
            ->title('Billing Successful')
            ->body('Transaction has been saved successfully.')
            ->success()
            ->send();
            //reload page
         //   return redirect()->route('pharmacy.receipt', $transaction);
            return redirect()->route('cashier.billing');
        })
        ->extraAttributes([
            'class' => 'w-full',
        ])
        ->requiresConfirmation();
    }

    public function render()
    {
        return view('livewire.cashier.bill-out');
    }
}
