<?php

namespace App\Filament\Resources\ProductionLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductionLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('machine.name')
                    ->label('Nama Mesin'),
                TextEntry::make('operator_name'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('temperature')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('shift')
                    ->badge(),
                TextEntry::make('recorded_at')
                    ->dateTime(),
                TextEntry::make('type'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}