<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PushWeeklyReportVolunteers extends Notification
{

    use Queueable;
    
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Weekly Report')
            ->icon('/notification-icon.png')
            ->body('The weekly report is ready to be filled.')
            ->action('View App', 'notification_action')
            ->options(['TTL' => 1000]);
    }
    
}