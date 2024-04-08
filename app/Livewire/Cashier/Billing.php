<?php

namespace App\Livewire\Cashier;

use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
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

class Billing extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query()->whereNotIn('type', ['Discharged']))
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
                    ->label('Initial Diagnosis')
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Date Added')
                    ->formatStateUsing(fn ($state) => $state->format('F j, Y h:i A'))
            ])
            ->filters([
                // ...
            ])
            ->headerActions([

            ])->actions([
                Action::make('billing')
                ->label('Billing')
                ->button()
                ->icon('heroicon-o-calculator')
                ->url(fn (Patient $record) => route('cashier.bill-out', $record)),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.cashier.billing');
    }
}
