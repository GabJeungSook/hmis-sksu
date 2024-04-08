<?php

namespace App\Livewire\Pharmacy;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Category;
use App\Models\Medicine;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use App\Models\Transaction as TransactionModel;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Transaction extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(TransactionModel::query())
            ->columns([
                TextColumn::make('transaction_number')
                ->searchable()
                ->badge()
                ->color('success'),
                TextColumn::make('sub_total')
                ->formatStateusing(fn ($state) => '₱ '. number_format($state, 2)),
                TextColumn::make('grand_total')
                ->formatStateusing(fn ($state) => '₱ '. number_format($state, 2)),
                TextColumn::make('created_at')
                ->label('Date')
                ->formatStateusing(fn ($state) => Carbon::parse($state)->format('F d, Y h:i A')),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([

            ])->actions([
                Action::make('view_receipt')
                ->label('Receipt')
                ->button()
                ->icon('heroicon-o-document-text')
                ->url(fn (TransactionModel $record) => route('pharmacy.receipt', $record)),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.pharmacy.transaction');
    }
}
