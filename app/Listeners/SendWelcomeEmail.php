<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;

class SendLoginNotification
{
    public function handle(UserLoggedIn $event)
    {
        Mail::to($event->user->email)->send(new LoginNotification($event->user));
    }
}
