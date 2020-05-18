<?php

namespace App;

trait Likable
{
    public function like($user = null, $liked = TRUE)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id()
            ],
            [
                'liked'   => $liked
            ]
        );
    }

    public function dislike($user = null)
    {
        return $this->like($user, FALSE);
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', TRUE)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', FALSE)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
