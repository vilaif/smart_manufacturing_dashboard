<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionLog extends Model
{
    protected $fillable = [
        'machine_id',
        'operator_name',
        'quantity',
        'temperature',
        'status',
        'shift',
        'recorded_at',
        'type',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }
}