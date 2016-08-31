<?php

namespace App\Transformers;

use App\Models\Book;
use App\Transformers\AuthorTransformer;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'author'
    ];

    public function transform(Book $book)
    {
        return [
            'judul'     => $book->title,
            'tahun'     => $book->year,
        ];
    }

    public function includeAuthor(Book $book)
    {
        $author   = $book->author;

        return $this->item($author, new AuthorTransformer);
    }
}
