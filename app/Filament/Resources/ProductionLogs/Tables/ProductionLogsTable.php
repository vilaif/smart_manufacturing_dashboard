<?php

namespace App\Filament\Resources\ProductionLogs\Tables;

use App\Models\Machine;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ProductionLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('machine.name')
                    ->label('Machine')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('operator_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('temperature')
                    ->suffix('°C')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Running' => 'success',
                        'Idle' => 'warning',
                        'Maintenance' => 'info',
                        'Error' => 'danger'
                    }),
                TextColumn::make('shift')
                    ->badge(),
                TextColumn::make('type'),
                TextColumn::make('recorded_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Running' => 'Running',
                        'Idle' => 'Idle',
                        'Maintenance' => 'Maintenance',
                        'Error' => 'Error',
                    ]),
                SelectFilter::make('shift')
                    ->options([
                        'Pagi' => 'Pagi',
                        'Siang' => 'Siang',
                        'Malam' => 'Malam',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}