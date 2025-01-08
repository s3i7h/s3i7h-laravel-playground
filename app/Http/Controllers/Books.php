<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\GetBookRequest;
use App\Http\Requests\ListBooksRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Books extends Controller
{
    public function list_books(ListBooksRequest $request): ResourceCollection
    {
        /**
         * @var string|int $limit
         */
        $limit = $request->validated('limit');
        $limit = (int)($limit ?: -1);
        $books = Book::query()->limit($limit)->get();

        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_book(CreateBookRequest $request): BookResource
    {
        /**
         * @var array<string, mixed> $input
         */
        $input = $request->validated();
        $book = new Book($input);
        $book->save();
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function get_book(int $id, GetBookRequest $request): BookResource
    {
        $book = Book::query()->find($id) ?: \abort(404);
        return new BookResource($book);
    }
}
