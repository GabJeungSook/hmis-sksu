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
            ->query(PatientInfo::query()->whereHas('referrals'))
            ->columns([
                TextColumn::make('fullName')
                ->formatStateUsing(fn (PatientInfo $record) => $record->first_name.' '.$record->last_name),
                TextColumn::make('referrals.hospital_name')               
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
                ->label('Add Referral')
                ->url(fn () => route('admin.add_referral'))
            ])->actions([
                // Action::make('manage_beds')
                // ->button()
                // ->color('primary')
                // ->icon('heroicon-o-plus-circle')
                // ->url(fn (Room $record) => route('admin.manage-beds', $record)),
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
