<?php

namespace App\Filament\Resources;

use App\Models\Test;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\LabRequest;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\LabRequestResource\Pages;

class LabRequestResource extends Resource
{
    protected static ?string $model = LabRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Select::make('tests')
                    ->multiple()
                    ->relationship('tests', 'name')
                    ->required(),
                Repeater::make('test_results')
                    ->schema([
                        Select::make('test_id')
                            ->label('Test')
                            ->options(fn () => Test::pluck('name', 'id'))
                            ->disabled()
                            ->required(),
                        TextInput::make('results')
                            ->label('Results'),
                    ])
                    ->columns(2)
                    ->visible(fn ($livewire) => $livewire instanceof EditRecord)
                    ->dehydrated(false), // We'll handle saving manually
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name'),
                TextColumn::make('status'),
                TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLabRequests::route('/'),
            'create' => Pages\CreateLabRequest::route('/create'),
            'edit' => Pages\EditLabRequest::route('/{record}/edit'),
        ];
    }
}
