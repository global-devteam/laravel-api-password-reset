<?php


namespace Globaldevteam\LaravelApiPasswordReset\app\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetSuccessNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $recipientName;

    public function __construct($recipientName)
    {
        $this->recipientName = $recipientName;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Senha alterada com sucesso')
            ->greeting('Olá ' . $this->recipientName . ',')
            ->line('Sua senha foi alterada com sucesso.')
            ->line('Se você solicitou esta alteração de senha não é necessário se preocupar.')
            ->line('Se você não solicitou esta alteração por favor envie um email para: contato@cicllos.com.br.')
            ->line('Atenciosamente,')
            ->salutation('Cicllos Tecnologia');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
