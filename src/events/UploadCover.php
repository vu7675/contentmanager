<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class UploadCover
{
    use SerializesModels;

    public $cover;
    public $folder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cover, $folder)
    {
        $this->cover = $cover;
        $this->folder = $folder;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
