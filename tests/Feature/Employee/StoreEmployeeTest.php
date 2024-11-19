<?php

namespace Employee;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ManagerAuth;

class StoreEmployeeTest extends TestCase
{
    use RefreshDatabase, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if employees can be retrieved with pagination, sorting, and search filters from Manager Role.
     *
     * @return void
     */
    public function test_store_employees_data_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }

    protected function doRequest($token): void
    {
        $data = [
            'email' => 'yudasmalabi@gmail.com',
            'password' => '12345678',
            'name' => 'Test Pegawai Baru',
            'phone_number' => '082257181297',
            'address' => 'Polinema',
            'company_id' => 1,
        ];

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/employees', $data);

        $response->assertStatus(201)
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
            'company_id' => $data['company_id'],
        ]);

    }
}
