<?php

namespace App\Livewire\Admin\Manage;

use App\Models\Room;
use App\Models\User;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Rooms extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Room::query())
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('description'),
                TextColumn::make('beds_count')->label('No. of Beds')->counts('beds'),
                // TextColumn::make('beds.name')
                // ->listWithLineBreaks()
                // ->bulleted()
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(Room::class)
                ->label('Add Room')
                ->modalHeading('Add Room')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->nullable()
                ])
            ])->actions([
                Action::make('manage_beds')
                ->button()
                ->color('primary')
                ->icon('heroicon-o-plus-circle')
                ->url(fn (Room $record) => route('admin.manage-beds', $record)),
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(Room::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->nullable()
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
        return view('livewire.admin.manage.rooms');
    }
}
