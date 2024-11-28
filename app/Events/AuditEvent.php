<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuditEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $action;
    public $model;
    public $old_data;
    public $new_data;
    public function __construct($user_id, $action, $model, $old_data = null, $new_data = null)
    {
        $this->user_id = $user_id;
        $this->action = $action;
        $this->model = $model;
        $this->old_data = $old_data;
        $this->new_data = $new_data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
