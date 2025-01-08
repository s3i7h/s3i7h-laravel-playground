<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\BookStock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookStockControllerTest extends TestCase
{
    use RefreshDatabase;

    public Book $book;
    public BookStock $stock;

    public function setUp(): void
    {
        parent::setUp();
        $this->book = Book::factory()->create();
        $this->stock = BookStock::factory()->create(['book_id' => $this->book->id]);
    }

    public function test_list_book_stocks(): void
    {
        $response = $this->get('/book-stocks');
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json
            ->has(1)
            ->has(
                0,
                fn (AssertableJson $json) => $json
                ->where('id', $this->stock->id)
                ->where('book_id', $this->stock->book_id)
                ->etc()
            )
        );
    }

    public function test_get_book_stocks(): void
    {
        $response = $this->get("/books/{$this->book->id}/stocks");
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json
            ->has(1)
            ->has(
                0,
                fn (AssertableJson $json) => $json
                ->where('id', $this->stock->id)
                ->where('book_id', $this->stock->book_id)
                ->etc()
            )
        );
    }

    public function test_create_book_stock(): void
    {
        $stock_data = [];
        $response = $this->post("/books/{$this->book->id}/stocks", $stock_data);
        $response->assertStatus(201);
        $response->assertJson(
            fn (AssertableJson $json) => $json
            ->has('id')
            ->where('book_id', $this->book->id)
            ->whereAll($stock_data)
            ->etc()
        );
    }

    public function test_get_book_stock(): void
    {
        $response = $this->get("/books/{$this->book->id}/stocks/{$this->stock->id}");
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json
            ->has('id')
            ->where('book_id', $this->stock->book_id)
            ->etc()
        );
    }
}
