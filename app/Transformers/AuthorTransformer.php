<?php

namespace App\Transformers;

use App\Models\Author;
use App\Transformers\AuthorTransformer;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract
{
    public function transform(Author $author)
    {
        return [
            'name'     => $author->name,
        ];
    }
}
