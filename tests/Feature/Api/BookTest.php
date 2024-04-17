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
    use RefreshDatabase, WithFaker;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

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
        $book = Book::inRandomOrder()->first();
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

    /**
     * Create book route test.
     *
     * @return void
     */
    public function test_books_item_created(): void
    {
        $this->withoutExceptionHandling();

        $data = [
            "title"             => rtrim($this->faker->sentence(5), '.'),
            "publisher"         => $this->faker->company(),
            "author"            => $this->faker->name(),
            "genre"             => $this->faker->randomElement(\App\Enums\Genre::class)->value,
            "publication_date"  => $this->faker->date(),
            "words_number"      => $this->faker->numberBetween(),
            "price"             => $this->faker->randomFloat(2, 0.01, 9999999.99)
        ];
        $response = $this->postJson('/api/books', $data);

        $this->assertDatabaseCount('books', \Database\Seeders\BookSeeder::SEED_COUNT + 1);

        $book = Book::latest()->first();

        $this->assertEquals($data['title'], $book->title);
        $this->assertEquals($data['publisher'], $book->publisher);
        $this->assertEquals($data['author'], $book->author);
        $this->assertEquals($data['genre'], $book->genre->value);
        $this->assertEquals($data['publication_date'], $book->publication_date->toDateString());
        $this->assertEquals($data['words_number'], $book->words_number);
        $this->assertEquals($data['price'], $book->price);

        $location = route('api.books.show', $book);

        $response->assertStatus(201)
            ->assertLocation($location)
            ->assertJson(['id' => $book->id]);
    }

    /**
     * @return void
     */
    public function test_books_item_genre_attr_is_valid(): void
    {
        $data = [
            "title"             => rtrim($this->faker->sentence(5), '.'),
            "publisher"         => $this->faker->company(),
            "author"            => $this->faker->name(),
            "genre"             => 'Fake',
            "publication_date"  => $this->faker->date(),
            "words_number"      => $this->faker->numberBetween(),
            "price"             => $this->faker->randomFloat(2, 0.01, 9999999.99)
        ];

        $this->postJson('/api/books', $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('genre');
    }

    /**
     * @return void
     */
    public function test_books_item_price_attr_is_valid(): void
    {
        $data = [
            "title"             => rtrim($this->faker->sentence(5), '.'),
            "publisher"         => $this->faker->company(),
            "author"            => $this->faker->name(),
            "genre"             => $this->faker->randomElement(\App\Enums\Genre::class)->value,
            "publication_date"  => $this->faker->date(),
            "words_number"      => $this->faker->numberBetween(),
            "price"             => 0
        ];

        $this->postJson('/api/books', $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('price');
    }

    /**
     * Create book route test.
     *
     * @return void
     */
    public function test_books_item_updated(): void
    {
        $this->withoutExceptionHandling();

        $book = Book::latest()->first();
        $data = [
            "price" => $this->faker->randomFloat(2, 0.01, 9999999.99)
        ];
        $response = $this->patchJson('/api/books/' . $book->id, $data);

        $book->refresh();

        $this->assertEquals($data['price'], $book->price);

        $resource = (new BookResource($book))->resolve();

        $response->assertStatus(200)->assertJson([
            'id' => $resource['id'],
            'price' => $resource['price']
        ]);
    }
}
