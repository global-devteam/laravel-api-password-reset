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
        $url = Config::get('apiPasswordRecovery.emailNotificationLink') . $this->token;

        return (new MailMessage())
            ->subject(__('api-password-recovery.subject'))
            ->markdown('vendor.api-password-recovery', ['url' => $url, "name" => $this->recipientName]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
