<?php

namespace App\Livewire\Admin\Manage;

use App\Models\User;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class DoctorFee extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('role_id', 2))
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
                    'laboratory' => 'info',
                })
                ->formatStateUsing(fn ($state) => strtoupper($state)),
                TextColumn::make('doctors_fee')
                ->label('Doctor\'s Fee')
                ->formatStateUsing(fn ($state) => '₱ '.number_format($state, 2)),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([

            ])->actions([
                EditAction::make('edit')
                ->label('Add Fee')
                ->button()
                ->color('success')
                ->model(User::class)
                ->form([
                    TextInput::make('doctors_fee')
                    ->label('Amount')
                    ->numeric()
                    ->autofocus()
                    ->prefix('₱')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required(),
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.manage.doctor-fee');
    }
}
