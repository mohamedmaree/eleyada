<?php

namespace App\Notifications;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyUser extends Notification
{
    use Queueable;
    use Firebase;
    private $MessageData;
   
    public function __construct($request)
    {
        $this->MessageData = [
            // 'sender'        => auth('admin')->id(),
            // 'sender_model'  => 'Admin',
            'title_ar'      => ($request['title_ar'])??'',
            'title_en'      => ($request['title_en'])??'',
            'body_ar'       => ($request['body_ar'])??'',
            'body_en'       => ($request['body_en'])??'',
            'type'          => 'admin_notify' ,
        ];
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        $tokens = [];
        $types  = [];
        if(count($notifiable->devices)){
            foreach ($notifiable->devices as $device) {
                $tokens[] = $device->device_id ; 
                $types[]  = $device->device_type ; 
            }
            $this->sendFcmNotification( $tokens ,$types ,$this->MessageData , $notifiable->lang ) ;
        }
        return $this->MessageData ;
    }
}
