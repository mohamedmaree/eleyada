<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlaceOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $emails = [
        'fady.mounir@dkteg.com',
        'roba@dkteg.com',
        'yassmin.swedan@dkteg.com',
        'taher.ali@dkteg.com',
        'mohamed.ihab@dkteg.com',
        'ramadan.khalaf@dkteg.com',
        'alibarakat@dkteg.com',
        'info@dkteg.com'
    ];

    /**
     * Create a new event instance.
     */
    public function __construct(public Order $order, string $email)
    {
        $this->emails[] = $email;
    }

}
