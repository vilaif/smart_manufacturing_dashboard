<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Machine extends Model
{
    protected $fillable = [
        'name',
        'type',
        'status',
        'current_temperature',
    ];

    public function productionLogs(): HasOne
    {
        return $this->hasOne(ProductionLog::class);
    }

}