<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Transformers\BookTransformer;
use Auth;

class BookController extends Controller
{
    public function all(Book $book)
    {
        $books  = $book->all();

        return fractal()
            ->collection($books)
            ->transformWith(new BookTransformer)
            ->toArray();
    }
}
