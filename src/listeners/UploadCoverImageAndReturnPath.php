<?php

namespace App\Listeners;

use App\Events\UploadCover;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadCoverImageAndReturnPath
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UploadCover  $event
     * @return void
     */
    public function handle(UploadCover $event)
    {
        $cover = $event->cover;
        if($cover != null){
            $path = $cover->store('public/images/'.$event->folder);
            return $path;
        }
        return null;
    }
}
