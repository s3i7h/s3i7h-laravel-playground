<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public Book $book;

    public function setUp(): void
    {
        parent::setUp();
        $this->book = Book::factory()->create();
    }

    public function test_list_books(): void
    {
        $response = $this->get('/books');
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json
            ->has(1)
            ->has(
                0,
                fn (AssertableJson $json) => $json
                ->where('id', $this->book->id)
                ->where('name', $this->book->name)
                ->where('isbn', $this->book->isbn)
                ->etc()
            )
        );
    }

    public function test_create_book(): void
    {
        $book_data = [
            'name' => 'test',
            'isbn' => '1234567890123',
        ];
        $response = $this->post('/books', $book_data);
        $response->assertStatus(201);
        $response->assertJsonFragment($book_data);
    }

    public function test_get_book(): void
    {
        $response = $this->get("/books/{$this->book->id}");
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json
            ->where('id', $this->book->id)
            ->where('name', $this->book->name)
            ->where('isbn', $this->book->isbn)
            ->etc()
        );
    }
}
