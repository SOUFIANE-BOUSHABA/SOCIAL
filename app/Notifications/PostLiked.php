<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    protected $liker;
    protected $post;

    public function __construct($liker, $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'liker_name' => $this->liker->name,
            'post_id' => $this->post->id,
        ];
    }

    // Add this method to specify the custom notification type
    public function getType($notifiable)
    {
        return 'post_liked';
    }
}
