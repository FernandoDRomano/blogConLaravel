<?php

namespace App\Notifications;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyOwnerPostDisapprove extends Notification implements ShouldQueue
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
                    ->subject(config('app.name') . ' - Post Desaprobado')
                    ->greeting('Hola ' . $notifiable->getFullName())
                    ->line('Tu post ' . $this->post->title . ', fue Desaprobado por nuestros moderadores. Revisalo por favor.')
                    ->action('Click aquí para ver el Post', route('admin.posts.show', $this->post))
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
            'title' => 'Post Desaprobado',
            'text' => 'Tu post ' . $this->post->title . ', fue Desaprobado por nuestros moderadores. Revisalo por favor.',
            'link' => route('admin.notifications.show', $this->id),
        ];
    }
}
