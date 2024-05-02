<?php

namespace App\Livewire\Admin\Manage;

use App\Models\Bed;
use App\Models\Room;
use App\Models\User;
use App\Models\Patient;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class AssignBed extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Patient Type')
                    ->sortable(),
                TextColumn::make('guardian_name')
                    ->label('Guardian')
                    ->searchable(),
                TextColumn::make('bed.room.name')
                    ->label('Room')
                    ->searchable(),
                TextColumn::make('bed.name')
                    ->label('Bed')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Date Added')
                    ->formatStateUsing(fn ($state) => $state->format('F j, Y h:i A'))
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                //
            ])->actions([
                EditAction::make('edit')
                ->label('Assign Bed')
                ->button()
                ->color('success')
                ->model(Patient::class)
                ->form([
                    Select::make('room_id')
                    ->label('Room')
                    ->required()
                    ->live()
                    ->options(Room::all()->pluck('name', 'id')),
                    Select::make('bed_id')
                    ->label('Bed')
                    ->required()
                    ->options(fn (Get $get): Collection => Bed::query()
                    ->where('room_id', $get('room_id'))
                    ->pluck('name', 'id'))
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.manage.assign-bed');
    }
}
