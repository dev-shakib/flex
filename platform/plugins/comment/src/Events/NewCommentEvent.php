<?php

namespace Botble\Comment\Events;

use Botble\Comment\Models\Comment;
use Botble\Comment\Models\CommentUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewCommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Comment
     */
    public $comment;

    /**
     * @var CommentUser
     */
    public $commentUser;

    /**
     * Create a new event instance.
     *
     * @param Comment $comment
     * @param CommentUser $commentUser
     */
    public function __construct(Comment $comment, CommentUser $commentUser)
    {
        $this->comment = $comment;
        $this->commentUser = $commentUser;
    }

    public function broadcastOn()
    {   
        return new Channel('comment');
    }
}
