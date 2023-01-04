<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $creator;

    public function __construct(String $message, Array $creator)
    {
        $this->message = $message;
        $this->creator = $creator;
    }

    public function broadcastOn()
    {
        return [$this->creator['channel']];
    }

    public function broadcastAs()
    {
        return $this->creator['event'];
    }
}