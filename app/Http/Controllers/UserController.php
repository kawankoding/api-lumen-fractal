<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Auth;

class UserController extends Controller
{
    public function all(User $user)
    {
        $paginator  = $user->paginate(5);
        $users      = $paginator->getCollection();

        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();
    }

    public function show(User $user, $id)
    {
        $user   = $user->find($id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->includeTweets()
            ->toArray();
    }

    public function mySelf()
    {
        return fractal()
            ->item(Auth::user())
            ->transformWith(new UserTransformer)
            ->includeTweets()
            ->toArray();
    }
}
