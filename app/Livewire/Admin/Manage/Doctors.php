<?php

namespace App\Livewire\Admin\Manage;

use App\Models\User;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Doctors extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->whereNot('role_id', 1))
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->formatStateUsing(fn ($record, $state) => $record->role_id === 2 ? 'Dr. '.ucwords($state) : ucwords($state)),
                TextColumn::make('email')
                ->searchable(),
                TextColumn::make('role.name')
                ->sortable()
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'doctor' => 'success',
                    'pharmacist' => 'warning',
                    'cashier' => 'primary',
                    'ipd / opd' => 'info',
                })
                ->formatStateUsing(fn ($state) => strtoupper($state)),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                ->model(User::class)
                ->label('Add User')
                ->modalHeading('Add User')
                ->form([
                    TextInput::make('name')
                        ->doesntStartWith(['admin'])
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->required()
                        ->maxLength(255),
                    Select::make('role_id')
                        ->label('Role')
                        ->required()
                        ->options([
                            '2' => 'Doctor',
                            '3' => 'Pharmacist',
                            '4' => 'Cashier',
                            '5' => 'IPD / OPD',
                        ]),
                ])
            ])->actions([
                EditAction::make('edit')
                ->button()
                ->color('success')
                ->model(User::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Select::make('role_id')
                        ->label('Role')
                        ->required()
                        ->options([
                            '2' => 'Doctor',
                            '3' => 'Pharmacist',
                            '4' => 'Cashier',
                            '5' => 'IPD / OPD',
                        ]),
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
        return view('livewire.admin.manage.doctors');
    }
}
