<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordRecoverySuccessNotification extends Notification implements ShouldQueue
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
    return (new MailMessage())
      ->subject(__('api-password-recovery.subject_success'))
      ->greeting('Hello ' . $this->recipientName . ',')
      ->greeting(__('api-password-recovery.greeting',['name'=>$this->recipientName]))
      ->line(__('api-password-recovery.success_message'));
  }

  /**
   * Get the array representation of the notification.
   *
   * @param mixed $notifiable
   *
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}
