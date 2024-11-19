<?php

namespace Employee;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ManagerAuth;

class UpdateEmployeeTest extends TestCase
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
    public function test_update_employees_data_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }

    protected function doRequest($token): void
    {
        $data = [
            'email' => 'yudasmalabi@gmail.com',
            'password' => '12345678',
            'name' => 'Test Pegawai Baru Update',
            'phone_number' => '082257181297',
            'address' => 'Polinema Update',
            'company_id' => 1,
        ];

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->patchJson('/api/employees/7', $data);

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
            'company_id' => $data['company_id'],
        ]);

    }
}
