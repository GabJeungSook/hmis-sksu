<?php

namespace App\Livewire\Admin\Manage;

use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\PatientInfo;
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


class Patients extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(PatientInfo::query())
            ->columns([
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('full_address')
                    ->label('Address')
                    ->sortable(),
                TextColumn::make('birthday')
                    ->label('Birthday')
                    ->date(),
                TextColumn::make('gender')
                    ->label('Gender'),
                // TextColumn::make('initial_diagnosis')
                //     ->label('Initial Diagnosis')
                //     ->wrap(),
                TextColumn::make('created_at')
                    ->label('Date Created')
                    ->formatStateUsing(fn ($state) => $state->format('F j, Y h:i A'))
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                // CreateAction::make()
                // ->model(PatientInfo::class)
                // ->label('Add Patient')
                // ->modalHeading('Add Patient')
                // ->form([
                //     Hidden::make('user_id')
                //     ->default(null),
                //     TextInput::make('name')
                //         ->label('Patient Name')
                //         ->required()
                //         ->maxLength(255),
                //     Select::make('type')
                //         ->required()
                //         ->label('Patient Type')
                //         ->required()
                //         ->options([
                //             'In-Patient' => 'In-Patient',
                //             'Out-Patient' => 'Out-Patient',
                //         ]),
                //     DatePicker::make('birth_date')
                //     ->label('Birthday')
                //     ->native(false),
                //     TextInput::make('contact_number')
                //         ->label('Contact Number')
                //         ->numeric()
                //         ->maxLength(11),
                //     Textarea::make('address'),
                //     Select::make('blood_type')
                //         ->label('Blood Type')
                //         ->searchable()
                //         ->options([
                //             'A+' => 'A+',
                //             'A-' => 'A-',
                //             'B+' => 'B+',
                //             'B-' => 'B-',
                //             'AB+' => 'AB+',
                //             'AB-' => 'AB-',
                //             'O+' => 'O+',
                //             'O-' => 'O-',
                //         ]),
                //     TextInput::make('guardian_name')
                //         ->label('Guardian Name')
                //         ->maxLength(255),

                // ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(PatientInfo::class)
                ->form([
                    Hidden::make('user_id')
                    ->default(null),
                    TextInput::make('first_name')
                        ->label('First Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('middle_name')
                        ->label('Middle Name')
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->label('Last Name')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('full_address')
                        ->label('Address')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('birthday')
                    ->label('Birthday')
                    ->native(false),
                    Select::make('gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female'
                        ])->required(),
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
