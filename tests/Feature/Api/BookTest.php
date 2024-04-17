<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\BookController;
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
}
