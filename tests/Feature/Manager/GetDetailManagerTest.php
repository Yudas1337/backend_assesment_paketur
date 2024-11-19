<?php

namespace Manager;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ManagerAuth;

class GetDetailManagerTest extends TestCase
{
    use RefreshDatabase, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if manager can be retrieved by ID from Manager Role.
     *
     * @return void
     */
    public function test_get_manager_detail_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }

    protected function doRequest($token): void
    {
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/managers/13');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'code',
                    'status',
                    'message',
                ],
                'data' => [
                    'name',
                    'phone_number',
                    'address',
                ]]);
    }
}
