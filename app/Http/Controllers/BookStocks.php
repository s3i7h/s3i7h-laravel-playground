<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookStockRequest;
use App\Http\Requests\GetBookStockRequest;
use App\Http\Requests\ListBookStocksRequest;
use App\Http\Resources\BookStockResource;
use App\Models\BookStock;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookStocks extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListBookStocksRequest $request): ResourceCollection
    {
        /**
         * @var string|int $limit
         */
        $limit = $request->validated('limit');
        $limit = (int)($limit ?: -1);
        $stocks = BookStock::query()->limit($limit)->get();

        return BookStockResource::collection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookStockRequest $request): BookStockResource
    {
        /**
         * @var array<string, mixed> $input
         */
        $input = $request->validated();
        $stock = new BookStock($input);
        $stock->save();
        return new BookStockResource($stock);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, GetBookStockRequest $request): BookStockResource
    {
        $stock = BookStock::query()->find($id) ?: \abort(404);
        return new BookStockResource($stock);
    }
}
