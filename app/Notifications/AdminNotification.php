<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AdminNotification extends Notification
{
    use Queueable;
    
    public $notice;

    public function __construct($notice)
    {
        $this->notice = $notice;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->notice->title,
            'content' => $this->notice->content,
            'created_at' => now(),
        ];
    }
}
