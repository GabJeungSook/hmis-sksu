<?php

namespace App\Livewire\Admin\Manage;

use Livewire\Component;
use App\Models\PatientInfo;
use App\Models\HealthRecord;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;

class HealthRecords extends Component implements HasForms, HasTable 
{

    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(PatientInfo::query()->whereHas('healthRecords'))
            ->columns([
                TextColumn::make('fullName')
                ->formatStateUsing(fn (PatientInfo $record) => $record->first_name.' '.$record->last_name),
                TextColumn::make('healthRecords.health_record')               
                ->listWithLineBreaks()
                ->bulleted(),
                TextColumn::make('created_at')->date(),
                // TextColumn::make('beds.name')
                // ->listWithLineBreaks()
                // ->bulleted()
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                Action::make('add-patient-record')
                ->label('Add Health Record')
                ->url(fn () => route('admin.add-health-record'))
            ])->actions([
                Action::make('view-record')
                ->label('View Health Record')
                ->button()
                ->color('warning')
                ->icon('heroicon-o-eye')
                ->url(fn (PatientInfo $record) => route('admin.view-health-record', $record)),
                // EditAction::make('edit')
                // ->button()
                // ->color('success')
                // ->model(Room::class)
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     Textarea::make('description')
                //         ->nullable(),
                //     TextInput::make('amount')
                //         ->label('Amount')
                //         ->numeric()
                //         ->autofocus()
                //         ->prefix('₱')
                //         ->mask(RawJs::make('$money($input)'))
                //         ->stripCharacters(',')
                //         ->required(),
                // ]),
                // DeleteAction::make('delete')
                // ->button()
                // ->requiresConfirmation()
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.manage.health-records');
    }
}
