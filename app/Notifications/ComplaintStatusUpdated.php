<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    // Specify the delivery channels (now using 'database')
    public function via($notifiable)
    {
        return ['database'];  // Using database instead of mail
    }

    // Define how the notification should be stored in the database
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => url('/complaints') // Link to the complaints page
        ];
    }
}
