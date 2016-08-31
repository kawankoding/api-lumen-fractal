<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Transformers\TweetTransformer;
use Auth;

class TweetController extends Controller
{
    public function userTweets(Tweet $tweet)
    {
        $tweets     = $tweet->byUser(Auth::user()->id)->paginate(10);

        return fractal()
            ->collection($tweets)
            ->transformWith(new TweetTransformer)
            ->toArray();
    }
}
