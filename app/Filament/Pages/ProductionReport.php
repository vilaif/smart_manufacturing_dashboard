<?php

namespace App\Filament\Pages;

use App\Models\ProductionLog;
use Filament\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductionReport extends Page
{
    protected static ?string $navigationLabel = 'Production Report';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::Document;
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.pages.production-report';

    public ?array $data = [];
    public ?string $shift = null;
    public ?string $date = null;
    public array $reportData = [];

    public function mount(): void
    {
        $this->form->fill([
            'date' => now()->toDateString(),
            'shift' => null
        ]);

        $this->generateReport();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Tanggal')
                    ->default(now())
                    ->live(),

                Select::make('shift')
                    ->label('Shift')
                    ->options([
                        'Pagi' => 'Pagi',
                        'Siang' => 'Siang',
                        'Malam' => 'Malam',
                    ])
                    ->placeholder('Semua Shift'),
            ])

            ->statePath('data');
    }

    public function generateReport()
    {
        $date = $this->data['date'] ?? now()->toDateString();
        $shift = $this->data['shift'] ?? null;

        $query = ProductionLog::query()
            ->selectRaw('DATE(recorded_at) as log_date, machine_id, shift, SUM(quantity) as total_qty, AVG(temperature) as avg_temperature, COUNT(DISTINCT operator_name) as total_operators')
            ->with('machine')
            ->whereDate('recorded_at', $date)
            ->groupBy('log_date', 'machine_id', 'shift');

        if (!empty($shift)) {
            $query->where('shift', $shift);
        }

        $this->reportData = $query->get()->toArray();
    }
}