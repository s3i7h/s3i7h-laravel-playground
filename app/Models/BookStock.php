<?php

namespace App\Models;

use Database\Factories\BookStockFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $book_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BookStock extends Model
{
    /** @use HasFactory<BookStockFactory> */
    use HasFactory;
}
