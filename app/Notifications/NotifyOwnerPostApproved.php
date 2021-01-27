<?php

namespace App\Notifications;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyOwnerPostApproved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
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
                    ->subject(config('app.name') . ' - Post Aprobado')
                    ->greeting('Hola ' . $notifiable->getFullName())
                    ->line('Tu post ' . $this->post->title . ', fue Aprobado por nuestros moderadores.')
                    ->action('Puedes ver el Post haciendo click aquí', route('pages.show.post', $this->post))
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
            'title' => 'Post Aprobado',
            'text' => 'Tu post ' . $this->post->title . ', fue Aprobado por nuestros moderadores.',
            'link' => route('admin.notifications.show', $this->id),
        ];
    }
}
