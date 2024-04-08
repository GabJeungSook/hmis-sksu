<?php

namespace App\Livewire\Doctor;

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


class Laboratories extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->role_id === 1 ? Patient::query()->whereNotIn('type', ['Discharged']) : Patient::where('user_id', auth()->id())->whereNotIn('type', ['Discharged']))
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Patient Type')
                    ->sortable(),
                TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->formatStateUsing(fn ($state) => 'Dr. '.$state)
                    ->sortable()
                    ->visible(auth()->user()->role_id === 1 ? true : false),
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

            ])->actions([
                Action::make('manage_laboratory')
                ->label('Manage Laboratory Tests')
                ->button()
                ->icon('heroicon-o-beaker')
                ->url(fn (Patient $record) => route('doctor.manage-labs', $record)),
            ])
            ->bulkActions([
                // ...
            ]);
    }


    public function render()
    {
        return view('livewire.doctor.laboratories');
    }
}
