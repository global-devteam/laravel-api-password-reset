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
            ->subject(__('message.subject'))
            ->greeting(__('message.greeting', [$this->recipientName]))
            ->line(__('message.intro'))
            ->action(__('message.buttonText'), $link)
            ->line(__('message.noFurtherActionRequired'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
