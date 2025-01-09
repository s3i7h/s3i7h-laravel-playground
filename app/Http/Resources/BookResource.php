<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property Book $resource
 */
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<mixed>|Arrayable<string, mixed>|JsonSerializable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        $model = $this->resource;
        return [
            'id' => $model->id,
            'name' => $model->name,
            'isbn' => $model->isbn,
        ];
    }
}
