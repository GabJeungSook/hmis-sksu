<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Category as CategoryModel;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Category extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(CategoryModel::query())
            ->columns([
                TextColumn::make('name')
                ->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(CategoryModel::class)
                ->label('Add Category')
                ->modalHeading('Add Category')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(CategoryModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ]),
                DeleteAction::make('delete')
                ->button()
                ->requiresConfirmation()
                ->visible(fn ($record) => $record->medicines->count() === 0)
            ])
            ->bulkActions([
                // ...
            ]);
    }


    public function render()
    {
        return view('livewire.admin.inventory.category');
    }
}
