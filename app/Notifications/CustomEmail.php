<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomEmail extends Notification
{
    use Queueable;
    // private $username;
    // private $email;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
       // echo $notifiable; exit; 
        
        $username = $notifiable->name;

        $email = $notifiable->email;

    

        return (new MailMessage)
                    
                    ->subject('Credentials')
                    ->greeting('Hello Dear ' . $username . ' ! ' )
                    ->line('You have been granted to use Archive Files Management System.')
                    ->line(' Your credentials are as follow :  ')
                    ->line(' ------------------------------------------- ')
                    ->line('Your Email: ' . $email)
                    ->line('Your Password: 12345678')
                    ->action('Go to System', url('/'))
                    ->line(' ------------------------------------------- ')
                    ->line('Web Address 1: http://172.16.0.3')
                    ->line('Web Address 2: http://archive.crida.local')
                    ->line('Please change your password as soon as you logged in to the system.')
                    ->line('Powered by: Good & Electronic Governance call GEP #153 for any queries ');
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
            //
        ];
    }
}
