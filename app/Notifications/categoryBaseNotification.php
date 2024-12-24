<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class categoryBaseNotification extends Notification
{
    use Queueable;

    public $user;

    public $violation;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $violation)
    {
        $this->user = $user;
        $this->violation = $violation;
    }

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
        return (new MailMessage)
                ->subject('Violation Notification')
                ->greeting('Hello '. $this->user->parent->first_name . '!')
                ->line('This is to inform you that '. $this->user->first_name . ' committed '. $this->violation->name  .' violation!')
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
