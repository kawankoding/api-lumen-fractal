<?php

namespace App\Transformers;

use App\Models\Tweet;
use App\Transformers\UserTransformer;
use League\Fractal\TransformerAbstract;

class TweetTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user'
    ];

    public function transform(Tweet $tweet)
    {
        return [
            'tweet'     => $tweet->tweet,
            'created'   => $tweet->created_at->diffForHumans(),
        ];
    }

    public function includeUser(Tweet $tweet)
    {
        $user   = $tweet->user;

        return $this->item($user, new UserTransformer);
    }
}
