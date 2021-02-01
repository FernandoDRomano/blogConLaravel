<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyUserOfCompletedExportFile extends Notification implements ShouldQueue
{
    use Queueable;

    public $pathFile;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pathFile)
    {
        $this->pathFile = $pathFile;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject(config('app.name') . ' - Descargar Reporte')
                ->greeting('Hola ' . $notifiable->getFullName())
                ->line('Tu reporte ya esta listo.')
                ->action('Has click aqui para descargarlo', url($this->pathFile))
                ->line('Gracías por usar nuestro blog.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Reporte Generado',
            'text' => 'Tu reporte ya esta listo, podes descargarlo haciendo click <a href="'. url($this->pathFile) .'" >aquí</a>' ,
            'link' => route('admin.notifications.show', $this->id),
        ];
    }
}
