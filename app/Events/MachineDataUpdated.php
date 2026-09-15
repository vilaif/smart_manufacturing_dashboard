<?php

namespace App\Events;

use App\Models\ProductionLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Event ini disiarkan tiap ada data produksi baru
// supaya browser bisa terima update tanpa refresh

class MachineDataUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Terima data ProductionLog yang baru dibuat
    public function __construct(public ProductionLog $log)
    {
        //
    }

    // Channel/saluran tempat event ini disiarkan
    public function broadcastOn(): array
    {
        return [
            new Channel('machine-monitoring'),
        ];
    }

    // Nama event yang dikenali di JS (Echo.listen('.machine.updated'))
    public function broadcastAs(): string
    {
        return 'machine.updated';
    }

    // Data yang dikirim ke browser
    public function broadcastWith(): array
    {
        return [
            'machine_id' => $this->log->machine_id,
            'machine_name' => $this->log->machine->name,
            'quantity' => $this->log->quantity,
            'status' => $this->log->status,
            'temperature' => $this->log->temperature,
            'operator' => $this->log->operator_name,
            'shift' => $this->log->shift,
            'type' => $this->log->type,
            'recorded_at' => $this->log->recorded_at->toDateTimeString(),
        ];
    }
}