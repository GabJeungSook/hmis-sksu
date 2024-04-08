<?php

namespace App\Livewire\Pharmacy;

use Livewire\Component;
use App\Models\Transaction;

class Receipt extends Component
{
    public $transaction;

    public function mount($record)
    {
        $this->transaction = Transaction::find($record);
    }

    public function render()
    {
        return view('livewire.pharmacy.receipt');
    }
}
