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
            ->subject(__('api-password-recovery.subject'))
            ->greeting(__('api-password-recovery.greeting', ["name"=>$this->recipientName]))
            ->line(__('api-password-recovery.intro'))
            ->action(__('api-password-recovery.buttonText'), $link)
            ->line(__('api-password-recovery.noFurtherActionRequired'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
