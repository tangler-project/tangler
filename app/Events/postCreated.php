<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Post;

class postCreated extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $post;


    public function __construct($post)
    {
        // $this->post = $post;
        // $this->post->img_url = $post->img_url;
        // $this->post->content = $post->content;
        // $this->post->owner_id = $post->owner_id;
        // $this->post->group_id = $post->group_id;
        // $this->post->vote_score = $post->vote_score;
        // $this->post->likes = $post->likes;
        // $this->post->dislikes = $post->dislikes;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        // return ['postChannel'];
    }
}
