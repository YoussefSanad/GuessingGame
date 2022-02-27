<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const CHANNEL_NAME = 'notification';

    public string $message;
    public int    $userID;
    public ?int   $winner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $message, int $userID, ?int $winner = null)
    {
        $this->message = $message;
        $this->userID = $userID;
        $this->winner = $winner;
    }


    /**
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel(self::CHANNEL_NAME);
    }
}
