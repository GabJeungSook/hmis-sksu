<?php

namespace App\Livewire\Admin\Manage;

use Filament\Forms\Get;
use Livewire\Component;
use App\Models\Medicine;
use Filament\Tables\Table;
use App\Models\PatientInfo;
use App\Models\HealthRecord;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;

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
                TextColumn::make('medicine.name')
                ->label('Medicine')
                ->formatStateUsing(fn (PatientInfo $record) => $record->medicine->name.' - '.$record->medicine_quantity),
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
                Action::make('issue-medicine')
                ->label('Issue Medicine')
                ->button()
                ->color('success')
                ->icon('heroicon-o-check')
                ->form([
                    Select::make('medicine_id')
                        ->label('Medicine')
                        ->options(Medicine::where('stock', '>', 0)->pluck('name', 'id'))
                        ->required()
                        ->live()
                        ->searchable()
                        ->placeholder('Select Medicine'),
                    TextInput::make('quantity')
                        ->label('Quantity')
                        ->required()
                        ->numeric()
                        ->maxValue(function (Get $get) {
                            $value = Medicine::find($get('medicine_id'));
                            return $value->stock ?? 0;
                        })
                        ->placeholder('Enter Quantity'),
                ])->action(function ($data, $record) {
                    $medicine = Medicine::find($data['medicine_id']);
                    $medicine->stock -= $data['quantity'];
                    $medicine->save();

                    $patient = PatientInfo::find($record->id);
                    $patient->medicine_id = $data['medicine_id'];
                    $patient->medicine_quantity = $data['quantity'];
                    $patient->save();

                    Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
                })->requiresConfirmation()->visible(fn (PatientInfo $record) => $record->medicine_id == null),
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
