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
            ->subject('Solicitação de alteração de senha')
            ->greeting('Olá ' . $this->recipientName . ',')
            ->line('Estamos lhe enviando este email por que você solicitou uma alteração de senha. Digite o código abaixo no aplicativo:')
            ->action($this->token, null)
            ->line('Caso não tenha solicitado esta alteração por favor ignore este email.')
            ->line('Atenciosamente,')
            ->salutation('Cicllos Tecnologia');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
