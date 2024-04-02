<?php

namespace App\Livewire\Pharmacy;

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
use App\Models\Medicine as MedicineModel;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Inventory extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(MedicineModel::query())
            ->columns([
                TextColumn::make('category.name')
                ->searchable()
                ->badge()
                ->color('success'),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('description'),
                TextColumn::make('price')
                ->formatStateusing(fn ($state) => '₱'. number_format($state, 2)),
                TextColumn::make('stock'),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([

            ])->actions([
                Action::make('manage_stock')
                ->label('Manage Stocks')
                ->button()
                ->icon('heroicon-o-pencil')
                ->url(fn (Medicine $record) => route('pharmacy.manage-stock', $record)),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.pharmacy.inventory');
    }
}
