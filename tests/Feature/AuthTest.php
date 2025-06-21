<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Summary of test_user_can_login
     * @return void
     */
    public function test_can_login(): void
    {
        $data = [
            'phone' => '99897123' . rand(1000, 9999),
            'password' => '1234567',
        ];

        $user = User::factory()->create($data);

        $response = $this->postJson('/api/auth/login', $data);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'access_token',
                    'refresh_token',
                    'at_expired_at',
                    'rf_expired_at',
                ]
            ]);

        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Summary of test_user_can_logout
     * @return void
     */
    public function test_can_logout(): void
    {
        $user = User::factory()->create([
            'phone' => '99897123' . rand(1000, 9999),
            'password' => '1234567',
        ]);

        $user->assignRole('admin');
        $token = $user->createToken('access-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/auth/logout', [],[
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);
    }

    /**
     * Summary of test_can_register
     * @return void
     */
    public function test_can_register()
    {
        $data = [
            "first_name" => "Pavel",
            "last_name" => "Durov",
            "phone" => "99897123" . rand(1000, 9999),
            "password" => "1234567",
        ];

        $response = $this->postJson('/api/auth/register', $data);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);
    }
}
