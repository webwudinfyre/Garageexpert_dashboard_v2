<?php

namespace App\Listeners;

use App\Events\trackstatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class trackstatusnotification
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
    public function handle(trackstatus $event): void
    {
        info('cnvm');
        $project = $event->status;
    }
}
