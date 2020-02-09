<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class PasswordResetRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $token;
    protected $recipientName;

    public function __construct($token, $recipientName)
    {
        $this->token = $token;
        $this->recipientName = $recipientName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $link = Config::get('apiPasswordReset.emailNotificationLink') . $this->token;

        return (new MailMessage())
            ->subject(__('email.subject'))
            ->greeting(__('email.greeting', [$this->recipientName]))
            ->line(__('email.intro'))
            ->action(__('email.buttonText'), $link)
            ->line(__('email.noFurtherActionRequired'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
