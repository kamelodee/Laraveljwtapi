<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to Our Platform')
            ->line('Thank you for registering with us!')
            ->action('Get Started', url('/'))
            ->line('We hope you enjoy using our service!');
    }
}