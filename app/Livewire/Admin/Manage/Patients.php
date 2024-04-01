<?php

namespace App\Livewire\Admin\Manage;

use App\Models\Patient;
use App\Models\User;
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


class Patients extends Component implements HasForms, HasTable
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
                TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->formatStateUsing(fn ($state) => 'Dr. '.$state)
                    ->sortable(),
                TextColumn::make('guardian_name')
                    ->label('Guardian')
                    ->searchable(),
                TextColumn::make('initial_diagnosis')
                    ->label('Initial Diagnosis'),
                TextColumn::make('created_at')
                    ->label('Date Added')
                    ->formatStateUsing(fn ($state) => $state->format('F j, Y h:i A'))
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(Patient::class)
                ->label('Add Patient')
                ->modalHeading('Add Patient')
                ->form([
                    Select::make('user_id')
                    ->label('Doctor')
                    ->required()
                    ->options(User::where('role_id', 2)->get()->pluck('name', 'id')),
                    TextInput::make('name')
                        ->label('Patient Name')
                        ->required()
                        ->maxLength(255),
                    Select::make('type')
                        ->required()
                        ->label('Patient Type')
                        ->required()
                        ->options([
                            'In-Patient' => 'In-Patient',
                            'Out-Patient' => 'Out-Patient',
                        ]),
                    DatePicker::make('birth_date')
                    ->label('Birthday')
                    ->native(false),
                    TextInput::make('contact_number')
                        ->label('Contact Number')
                        ->numeric()
                        ->maxLength(11),
                    Textarea::make('address'),
                    Select::make('blood_type')
                        ->label('Blood Type')
                        ->searchable()
                        ->options([
                            'A+' => 'A+',
                            'A-' => 'A-',
                            'B+' => 'B+',
                            'B-' => 'B-',
                            'AB+' => 'AB+',
                            'AB-' => 'AB-',
                            'O+' => 'O+',
                            'O-' => 'O-',
                        ]),
                    TextInput::make('guardian_name')
                        ->label('Guardian Name')
                        ->maxLength(255),
                    Textarea::make('initial_diagnosis')
                        ->label('Initial Diagnosis')
                ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(Patient::class)
                ->form([
                    Select::make('user_id')
                    ->label('Doctor')
                    ->required()
                    ->options(User::where('role_id', 2)->get()->pluck('name', 'id')),
                    TextInput::make('name')
                        ->label('Patient Name')
                        ->required()
                        ->maxLength(255),
                    Select::make('type')
                        ->required()
                        ->label('Patient Type')
                        ->required()
                        ->options([
                            'In-Patient' => 'In-Patient',
                            'Out-Patient' => 'Out-Patient',
                        ]),
                    DatePicker::make('birth_date')
                    ->label('Birthday')
                    ->native(false),
                    TextInput::make('contact_number')
                        ->label('Contact Number')
                        ->numeric()
                        ->maxLength(11),
                    Textarea::make('address'),
                    Select::make('blood_type')
                        ->label('Blood Type')
                        ->searchable()
                        ->options([
                            'A+' => 'A+',
                            'A-' => 'A-',
                            'B+' => 'B+',
                            'B-' => 'B-',
                            'AB+' => 'AB+',
                            'AB-' => 'AB-',
                            'O+' => 'O+',
                            'O-' => 'O-',
                        ]),
                    TextInput::make('guardian_name')
                        ->label('Guardian Name')
                        ->maxLength(255),
                    Textarea::make('initial_diagnosis')
                        ->label('Initial Diagnosis')
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
        return view('livewire.admin.manage.patients');
    }
}
