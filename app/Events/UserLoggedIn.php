<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;

class UserLoggedIn
{
    use Dispatchable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $recipient = $user->email;
        Mail::to($recipient)->send(new LoginNotification($user));
        $this->user = $user;
    }
}