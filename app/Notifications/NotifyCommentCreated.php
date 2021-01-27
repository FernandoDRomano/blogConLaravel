<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyCommentCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
                    ->subject(config('app.name') . ' - Comentario Creado')
                    ->greeting('Hola ' . $notifiable->getFullName())
                    ->line('Se creo un nuevo Comentario de ' . $this->comment->user->getFullName() . ', no te olvides de revisarlo luego.')
                    ->action('Puedes ver el Comentario haciendo click aquí', route('admin.comments.index', $this->comment))
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
            'title' => 'Comentario Creado',
            'text' => 'Se creo un nuevo Comentario de ' . $this->comment->user->getFullName() . ', no te olvides de revisarlo luego.',
            'link' => route('admin.comments.index', $this->comment),
        ];
    }
}
