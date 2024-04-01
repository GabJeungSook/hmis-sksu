<?php

namespace App\Livewire\Doctor;

use App\Models\Patient;
use App\Models\User;
use App\Models\PatientVitals;
use Livewire\Component;
use Filament\Tables\Table;
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

class Vitals extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(PatientVitals::query())
            ->columns([
                TextColumn::make('patient.name')
                    ->searchable(),
                TextColumn::make('temperature')
                    ->searchable()
                    ->label('Temperature (°C)'),
                TextColumn::make('blood_pressure')
                    ->searchable()
                    ->label('Blood Pressure'),
                TextColumn::make('heart_rate')
                    ->searchable()
                    ->label('Heart Rate'),
                TextColumn::make('respiratory_rate')
                    ->searchable()
                    ->label('Respiratory Rate'),
                TextColumn::make('created_at')
                    ->searchable()
                    ->label('Date Added')
                    ->formatStateUsing(fn ($state) => $state->format('F j, Y h:i A')),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(PatientVitals::class)
                ->label('Add Patient Vitals')
                ->modalHeading('Add Patient Vitals')
                ->form([
                    Select::make('patient_id')
                    ->label('Patient')
                    ->required()
                    ->options(Patient::pluck('name', 'id')),
                    TextInput::make('temperature')
                        ->label('Temperature (°C)')
                        ->numeric()
                        ->inputMode('decimal')
                        ->minValue(1)
                        ->maxValue(100)
                        ->required()
                        ->maxLength(255),
                    TextInput::make('blood_pressure')
                        ->label('Blood Pressure')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('heart_rate')
                        ->label('Heart Rate')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('respiratory_rate')
                        ->label('Respiratory Rate')
                        ->required()
                        ->maxLength(255),
                ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(PatientVitals::class)
                ->form([
                    Select::make('patient_id')
                    ->label('Patient')
                    ->required()
                    ->options(Patient::pluck('name', 'id')),
                    TextInput::make('temperature')
                        ->label('Temperature (°C)')
                        ->numeric()
                        ->inputMode('decimal')
                        ->minValue(1)
                        ->maxValue(100)
                        ->required()
                        ->maxLength(255),
                    TextInput::make('blood_pressure')
                        ->label('Blood Pressure')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('heart_rate')
                        ->label('Heart Rate')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('respiratory_rate')
                        ->label('Respiratory Rate')
                        ->required()
                        ->maxLength(255),
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
        return view('livewire.doctor.vitals');
    }
}
