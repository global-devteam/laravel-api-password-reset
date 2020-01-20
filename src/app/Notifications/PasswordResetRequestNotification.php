<?php


namespace Globaldevteam\LaravelApiPasswordReset\app\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
        return (new MailMessage)
            ->subject('Password reset request')
            ->greeting('Hello ' . $this->recipientName . ',')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Change Password', 'some/non/api/link/' . $this->token)
            ->line('If you did not request a password reset, no further action is required.');

    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
