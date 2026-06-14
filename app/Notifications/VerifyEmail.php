<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    use Queueable;



    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Verifica tu dirección de correo electrónico en PennyWise')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Haz clic en el botón de abajo para verificar tu dirección de correo electrónico.')
            ->action('Verificar Correo', $verificationUrl)
            ->line('Si no creaste una cuenta, no es necesario realizar ninguna acción adicional.')
            ->salutation('¡Gracias por unirte a PennyWise!');
    }


}
