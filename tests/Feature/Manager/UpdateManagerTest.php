<?php

namespace Manager;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ManagerAuth;

class UpdateManagerTest extends TestCase
{
    use RefreshDatabase, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if employees can be updated from Manager Role.
     *
     * @return void
     */
    public function test_update_manager_data_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }

    protected function doRequest($token): void
    {
        $data = [
            'email' => 'manager@gmail.com',
            'password' => '12345678',
            'name' => 'Tester Manager Update',
            'phone_number' => '082257181297',
            'address' => 'Malang Raya Update',
        ];

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->patchJson('/api/update-manager-profile', $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'code',
                    'status',
                    'message',
                ]]);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);

        $this->assertDatabaseHas('employee_details', [
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
        ]);

    }
}
