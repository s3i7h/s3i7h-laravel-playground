<?php

namespace App\Models;

use Database\Factories\BookStockFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $book_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BookStock extends Model
{
    /** @use HasFactory<BookStockFactory> */
    use HasFactory;

    protected $fillable = ['book_id'];
}
