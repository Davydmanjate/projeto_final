<?php

namespace App\Listeners;

use App\Events\AuditEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuditListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuditEvent $event): void
    {
        Audit::create([
            'user_id' => $event->user_id,
            'action' => $event->action,
            'model' => $event->model,
            'old_data' => $event->old_data,
            'new_data' => $event->new_data,
        ]);
    }
}
