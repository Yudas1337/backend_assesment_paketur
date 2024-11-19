<?php

namespace Manager;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ManagerAuth;

class GetManagerTest extends TestCase
{
    use RefreshDatabase, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if managers can be retrieved with pagination, sorting, and search filters from Manager Role.
     *
     * @return void
     */
    public function test_get_manager_pagination_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }

    protected function doRequest(string $token): void
    {
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/managers?sort=desc&perPage=10&search=');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'code',
                    'status',
                    'message',
                    'pagination'
                ],
            ]);
    }
}
