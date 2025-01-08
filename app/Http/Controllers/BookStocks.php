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
    public function list_book_stocks(ListBookStocksRequest $request): ResourceCollection
    {
        /**
         * @var string|int $limit
         */
        $limit = $request->validated('limit');
        $limit = (int)($limit ?: -1);
        $stocks = BookStock::query()->limit($limit)->get();

        return BookStockResource::collection($stocks);
    }

    public function get_book_stocks(int $book_id, GetBookStocksRequest $request): ResourceCollection
    {
        /**
         * @var string|int $limit
         */
        $limit = $request->validated('limit');
        $limit = (int)($limit ?: -1);
        $stocks = BookStock::query()->where('book_id', $book_id)->limit($limit)->get();

        return BookStockResource::collection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_book_stock(int $book_id, CreateBookStockRequest $request): BookStockResource
    {
        /**
         * @var array<string, mixed> $input
         */
        $input = $request->validated();
        $book = Book::query()->find($book_id) ?: \abort(404);
        $stock = new BookStock($input);
        $stock->book_id = $book->id;
        $stock->save();
        return new BookStockResource($stock);
    }

    /**
     * Display the specified resource.
     */
    public function get_book_stock(int $book_id, int $book_stock_id, GetBookStockRequest $request): BookStockResource
    {
        $stock = BookStock::query()->where('book_id', $book_id)->find($book_stock_id) ?: \abort(404);
        return new BookStockResource($stock);
    }
}
