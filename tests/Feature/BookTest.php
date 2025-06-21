<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Summary of test_book_can_get_all
     * @return void
     */
    public function test_book_can_get_all(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling();
        $response = $this->getJson("/api/books");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => [
                         'items' => [
                             [
                                 'id',
                                 'title',
                                 'author',
                                 'description',
                                 'cover_image',
                                 'available_copies',
                                 'created_at',
                                 'updated_at',
                             ]
                         ],
                         'pagination' => [
                             'current_page',
                             'per_page',
                             'last_page',
                             'total'
                         ]
                     ]
                 ]);
    }

    /**
     * Summary of test_book_can_show
     * @return void
     */
    public function test_book_can_show(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $book = Book::inRandomOrder()->first();

        $response = $this->getJson('/api/books/' . $book->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'title',
                    'author',
                    'description',
                    'cover_image',
                    'available_copies',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    /**
     * Summary of test_book_can_create
     * @return void
     */
    public function test_book_can_create(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $photo = UploadedFile::fake()->image('book.jpg');

        $data = [
            'title' => "laravel book",
            'author' => "Taylor Otwell",
            'description' => "laravel framework",
            'cover_image' => $photo,
            'available_copies' => 9,
        ];

        $response = $this->postJson("/api/books/create", $data);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

        $this->assertDatabaseHas('books', [
            'title' => "laravel book",
            'author' => "Taylor Otwell",
            'description' => "laravel framework",
        ]);
    }

    /**
     * Summary of test_book_can_update
     * @return void
     */
    public function test_book_can_update(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $book = Book::inRandomOrder()->first();

        $photo = UploadedFile::fake()->image('newBook.jpg');

        $title = "laravel book new";
        $author = "Taylor Otwell new";
        $description = "laravel framework new";
        $availableCopies = 10;

        $data = [
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'cover_image' => $photo,
            'available_copies' => $availableCopies,
        ];

        if (Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $response = $this->putJson('/api/books/update/' . $book->id, $data);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

        $this->assertDatabaseHas('books', [
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'available_copies' => $availableCopies,
        ]);
    }

    /**
     * Summary of test_book_can_delete
     * @return void
     */
    public function test_book_can_delete(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $book = Book::inRandomOrder()->first();

        $response = $this->deleteJson('/api/books/delete/' . $book->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

        $this->assertSoftDeleted('books', [
            'id' => $book->id,
        ]);
    }
}
