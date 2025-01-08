<?php

namespace App\Http\Resources;

use App\Models\BookStock;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class BookStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<mixed>|Arrayable<string, mixed>|JsonSerializable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        /** @var BookStock $model */
        $model = $this->resource;
        return [
            'id' => $model->id,
            'book_id' => $model->book_id,
        ];
    }
}
