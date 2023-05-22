<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateVendorAboutOrder // implements ShouldQueue //here if we use the interface 'ShouldQueue' it going dispatch the heavy prosess(jop) in the listener to the queue ,to make project run faster
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
    public function handle(OrderPlaced $event): void
    {
        Log::channel('mylog')->info('vendor was updated about order '.$event->order->id);
    }
}
