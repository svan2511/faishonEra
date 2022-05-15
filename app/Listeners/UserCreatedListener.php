<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UserCreatedListener
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
     * @param  \App\Events\UserCreatedEvent  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        
        session(['USER_TYPE' => "USR",'FRONT_USER_LOGGED_IN' => true ,'FRONT_USER_LOGGED_ID' => $event->user->id ,'FRONT_USER_LOGGED_NAME' => $event->user->name ]);
    }
}
