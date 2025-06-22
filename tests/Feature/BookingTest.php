<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
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
    public function test_booking_can_get_all(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling();
        $response = $this->getJson("/api/bookings");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => [
                         'items',
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
     * Summary of test_booking_can_show
     * @return void
     */
    public function test_booking_can_show(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $booking = Booking::inRandomOrder()->first();

        $response = $this->getJson('/api/bookings/' . $booking->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'user_id',
                    'book',
                    'status',
                    'booking_date',
                    'return_date',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    /**
     * Summary of test_booking_can_create
     * @return void
     */
    public function test_booking_can_create(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $book = Book::inRandomOrder()->first();

        $data = [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ];

        $response = $this->postJson("/api/bookings/create", $data);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);
    }

    /**
     * Summary of test_booking_can_update
     * @return void
     */
    public function test_booking_can_update(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $booking = Booking::inRandomOrder()->first();

        $book = Book::inRandomOrder()->first();
        $status = "returned";
        $returnDate = now();

        $data = [
            'book_id' => $book->id,
            'status' => $status,
            'return_date' => $returnDate,
        ];

        $response = $this->putJson('/api/bookings/update/' . $booking->id, $data);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'book_id' => $book->id,
            'status' => $status,
            'return_date' => $returnDate,
        ]);
    }

    /**
     * Summary of test_booking_can_delete
     * @return void
     */
    public function test_booking_can_delete(): void
    {
        $user = User::find(1)->first();
        $this->actingAs($user);

        $booking = Booking::inRandomOrder()->first();

        $response = $this->deleteJson('/api/bookings/delete/' . $booking->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

        $this->assertSoftDeleted('bookings', [
            'id' => $booking->id,
        ]);
    }
}
