<?php

namespace App\Livewire\Admin\Manage;

use Carbon\Carbon;
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
use Filament\Tables\Actions\Action;
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
                TextColumn::make('bed_added_at')
                    ->label('Days Admitted')
                    ->formatStateUsing(function ($state) {
                        //calculate days admitted

                        $days = abs(now()->diffInDays($state));
                        //convert $days to whole number
                        $days = intval($days);

                        if($days == 0)
                            return 'Today';
                        else if($days == 1)
                            return 'Yesterday';
                        else if($days > 1)
                            return $days . ' days ago';
                        else
                            return 'Just now';

                    })
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                //
            ])->actions([
                Action::make('edit')
                ->label('Assign Bed')
                ->button()
                ->color('success')
                ->model(Patient::class)
                ->form([
                    DatePicker::make('bed_added_at')
                    ->label('Date')->readonly()
                    ->default(now())
                    ->required(),
                    // Hidden::make('bed_added_at')
                    // ->default(now()),
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
                ->action(function ($record, array $data){
                    $record->update([
                        'room_id' => $data['room_id'],
                        'bed_id' => $data['bed_id'],
                        'bed_added_at' => $data['bed_added_at']
                    ]);
                })
                ->visible(fn ($record) => $record->bed_added_at == null),
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
