<?php

namespace App\Listeners;

use App\Events\PlaceOrder;
use App\Mail\OrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderMail
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
    public function handle(PlaceOrder $event): void
    {
        Mail::send(new OrderMail($event->order, $event->emails));
    }
}
