<?php

namespace App\Filament\Resources\ProductionLogs\Schemas;

use App\Models\Machine;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductionLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('machine_id')
                    ->label('Machine')
                    ->options(Machine::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('operator_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('temperature')
                    ->numeric()
                    ->suffix('°C')
                    ->nullable(),
                Select::make('status')
                    ->options(['Running' => 'Running', 'Idle' => 'Idle', 'Maintenance' => 'Maintenance', 'Error' => 'Error'])
                    ->default('Idle')
                    ->required(),
                Select::make('shift')
                    ->options(['Pagi' => 'Pagi', 'Siang' => 'Siang', 'Malam' => 'Malam'])
                    ->required(),
                DateTimePicker::make('recorded_at')
                    ->default(now())
                    ->required(),
                Select::make('type')
                    ->label('Type Production')
                    ->options(['A' => 'A', 'B' => 'B', 'C' => 'C']),
            ]);
    }
}