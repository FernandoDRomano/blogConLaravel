<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyPostDelete extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
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
                    ->subject(config('app.name') . ' - Post Eliminado')
                    ->greeting('Hola ' . $notifiable->getFullName())
                    ->line('Tu post ' . $this->post . ', fue Eliminado por nuestros moderadores. Ponte en contacto con ellos')
                    ->action('Click aquí para ver la notificación', route('admin.notifications.show', $this->id))
                    ->line('No contestar este correo.');
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
            'title' => 'Post Eliminado',
            'text' => 'Tu post ' . $this->post . ', fue Eliminado por nuestros moderadores. Ponte en contacto con ellos.',
            'link' => route('admin.notifications.show', $this->id),
        ];
    }
}
