<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\Category;
use Filament\Tables\Table;
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

class Medicine extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(MedicineModel::query())
            ->columns([
                TextColumn::make('category.name')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('description'),
                TextColumn::make('price')
                ->formatStateusing(fn ($state) => '₱'. number_format($state, 2)),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(MedicineModel::class)
                ->label('Add Medicine')
                ->modalHeading('Add Medicine')
                ->form([
                    Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id'))
                        ->required(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                    ->required(),
                    TextInput::make('price')
                        ->required()
                        ->numeric(),
                Hidden::make('stock')
                    ->default(0)
                ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(MedicineModel::class)
                ->form([
                    Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                ->required(),
                TextInput::make('price')
                        ->required()
                        ->numeric(),
                Hidden::make('stock')
                    ->default(0)
                ]),
                DeleteAction::make('delete')
                ->button()
                ->requiresConfirmation()
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.inventory.medicine');
    }
}
