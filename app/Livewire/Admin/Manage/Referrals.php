<?php

namespace App\Livewire\Admin\Manage;

use Livewire\Component;
use App\Models\PatientInfo;
use App\Models\Referral;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;

class Referrals extends Component implements HasForms, HasTable 
{
    
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Referral::query())
            ->columns([
                TextColumn::make('fullName')
                ->formatStateUsing(fn (PatientInfo $record) => $record->first_name.' '.$record->last_name),
                TextColumn::make('hospital_name'),
                TextColumn::make('doctor_name'),
                TextColumn::make('diagnosis'),
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
                ->label('Add Referral')
                ->url(fn () => route('admin.add_referral'))
            ])->actions([
                Action::make('view-referral-details')
                ->label('View Referral Form')
                ->button()
                ->color('warning')
                ->icon('heroicon-o-eye')
                ->url(fn (Referral $record) => route('admin.view-referral-details', ['record' => $record->patient, 'id' => $record->id])),
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
            ])->emptyStateHeading('No Record Yet');
    }

    public function render()
    {
        return view('livewire.admin.manage.referrals');
    }
}
