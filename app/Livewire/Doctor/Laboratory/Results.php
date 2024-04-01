<?php

namespace App\Livewire\Doctor\Laboratory;

use App\Models\User;
use App\Models\Patient;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\LaboratoryTest;
use App\Models\LaboratoryResult;
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

class Results extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(LaboratoryResult::query())
            ->columns([
                TextColumn::make('laboratoryTest.patient.name')
                    ->searchable(),
                TextColumn::make('laboratoryTest.test')
                    ->searchable(),
                // TextColumn::make('temperature')
                //     ->searchable()
                //     ->label('Temperature (°C)'),
                // TextColumn::make('blood_pressure')
                //     ->searchable()
                //     ->label('Blood Pressure'),
                // TextColumn::make('heart_rate')
                //     ->searchable()
                //     ->label('Heart Rate'),
                // TextColumn::make('respiratory_rate')
                //     ->searchable()
                //     ->label('Respiratory Rate'),
                // TextColumn::make('created_at')
                //     ->searchable()
                //     ->label('Date Added')
                //     ->formatStateUsing(fn ($state) => $state->format('F j, Y h:i A')),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(LaboratoryResult::class)
                ->label('Add Lab Result')
                ->modalHeading('Add Lab Result')
                ->form([
                    Select::make('patient_id')
                    ->label('Patient')
                    ->live()
                    ->required()
                    ->options(Patient::pluck('name', 'id')),
                    Select::make('laboratory_test_id')
                    ->label('Laboratory Test')
                    ->required()
                    ->options(fn (Get $get) => LaboratoryTest::where('patient_id', $get('patient_id'))->pluck('test', 'id')),
                    MarkdownEditor::make('result')
                    ->label('Laboratory Result')
                ])->mutateFormDataUsing(function (array $data): array {
                    $data = ['laboratory_test_id' => $data['laboratory_test_id'],
                              'result' => $data['result']];

                    return $data;
                })
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(LaboratoryResult::class)
                ->form([
                    Select::make('patient_id')
                    ->label('Patient')
                    ->required()
                    ->options(Patient::pluck('name', 'id')),
                    MarkdownEditor::make('result')
                    ->label('Laboratory Result')
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
        return view('livewire.doctor.laboratory.results');
    }
}
