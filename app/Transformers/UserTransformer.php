<?php

namespace App\Transformers;

use App\Models\User;
use App\Transformers\TweetTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tweets'
    ];

    public function transform(User $user)
    {
        return [
            'name'      => $user->name,
            'email'     => $user->email,
            'address'   => $user->address,
            'phone'     => $user->phone,
        ];
    }

    public function includeTweets(User $user)
    {
        $tweets     = $user->tweets()->terbaru()->get();

        return $this->collection($tweets, new TweetTransformer);
    }
}
