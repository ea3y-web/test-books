<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\BookController;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * List all books route test.
     *
     * @return void
     */
    public function test_books_listing_retrieved(): void
    {
        $this->getJson('/api/books')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(BookController::PER_PAGE_DEFAULT, 'data')
            ->assertJsonMissingPath('meta.links');
    }

    /**
     * List all books route with "per_page" query param test.
     *
     * @return void
     */
    public function test_books_listing_limited(): void
    {
        $this->getJson('/api/books?per_page=100')
            ->assertJsonCount(BookController::PER_PAGE_MAX, 'data')
            ->assertJsonPath('meta.per_page', BookController::PER_PAGE_MAX);
    }

    /**
     * List all books route with "page" query param test.
     *
     * @return void
     */
    public function test_books_listing_paged(): void
    {
        $this->getJson('/api/books?page=2')
            ->assertJsonPath('links.prev', fn ($link) => ! empty($link))
            ->assertJsonPath('meta.current_page', 2);
    }

    /**
     * Get book route test.
     *
     * @return void
     */
    public function test_books_item_retrieved(): void
    {
        $book = Book::factory()->create();
        $resource = (new BookResource($book))->resolve();

        $this->getJson('/api/books/' . $book->id)
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson([
                'id'                => $resource['id'],
                'title'             => $resource['title'],
                'publisher'         => $resource['publisher'],
                'author'            => $resource['author'],
                'genre'             => $resource['genre'],
                'publication_date'  => $resource['publication_date'],
                'words_number'      => $resource['words_number'],
                'price'             => $resource['price']
            ]);
    }

    /**
     * Test book item request with invalid ID.
     *
     * @return void
     */
    public function test_books_item_not_found(): void
    {
        $this->getJson('/api/books/0')
            ->assertStatus(404);
    }
}
