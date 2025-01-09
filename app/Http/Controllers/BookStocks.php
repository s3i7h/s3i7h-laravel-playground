<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookStockRequest;
use App\Http\Requests\GetBookStockRequest;
use App\Http\Requests\GetBookStocksRequest;
use App\Http\Requests\ListBookStocksRequest;
use App\Http\Resources\BookStockResource;
use App\Models\Book;
use App\Models\BookStock;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookStocks extends Controller
{
    public function listBookStocks(ListBookStocksRequest $request): ResourceCollection
    {
        /**
         * @var string|int $limit
         */
        $limit = $request->validated('limit');
        $limit = (int)($limit ?: -1);
        $stocks = BookStock::query()->limit($limit)->get();

        return BookStockResource::collection($stocks);
    }

    public function getBookStocks(int $bookId, GetBookStocksRequest $request): ResourceCollection
    {
        /**
         * @var string|int $limit
         */
        $limit = $request->validated('limit');
        $limit = (int)($limit ?: -1);
        $stocks = BookStock::query()->where('book_id', $bookId)->limit($limit)->get();

        return BookStockResource::collection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createBookStock(int $bookId, CreateBookStockRequest $request): BookStockResource
    {
        /**
         * @var array<string, mixed> $input
         */
        $input = $request->validated();
        $book = Book::query()->find($bookId) ?: \abort(404);
        $stock = new BookStock($input);
        $stock->book_id = $book->id;
        $stock->save();
        return new BookStockResource($stock);
    }

    /**
     * Display the specified resource.
     */
    public function getBookStock(int $bookId, int $bookStockId, GetBookStockRequest $request): BookStockResource
    {
        $stock = BookStock::query()->where('book_id', $bookId)->find($bookStockId) ?: \abort(404);
        return new BookStockResource($stock);
    }
}
