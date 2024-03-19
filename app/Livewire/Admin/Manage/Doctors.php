<?php

namespace App\Livewire\Admin\Manage;

use App\Models\User;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Doctors extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(User::class)
                ->label('Add Doctor')
                ->modalHeading('Add Doctor')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])
            ])->actions([

            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.manage.doctors');
    }
}
