<?php

namespace App\Livewire\Doctor\Laboratory;

use App\Models\Patient;
use App\Models\User;
use App\Models\LaboratoryTest;
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

class Tests extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->role_id === 1 ? LaboratoryTest::query() : LaboratoryTest::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('patient.name')
                    ->searchable(),
                TextColumn::make('test')
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
                ->model(LaboratoryTest::class)
                ->label('Add Lab Test')
                ->modalHeading('Add Lab Test')
                ->form([
                    Select::make('patient_id')
                    ->label('Patient')
                    ->required()
                    ->options(Patient::pluck('name', 'id')),
                    MarkdownEditor::make('test')
                    ->label('Laboratory Test')
                ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(LaboratoryTest::class)
                ->form([
                    Select::make('patient_id')
                    ->label('Patient')
                    ->required()
                    ->options(Patient::pluck('name', 'id')),
                    MarkdownEditor::make('test')
                    ->label('Laboratory Test')
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
        return view('livewire.doctor.laboratory.tests');
    }
}
