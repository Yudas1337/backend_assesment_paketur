<?php

namespace Employee;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\EmployeeAuth;
use Tests\Traits\ManagerAuth;

class GetDetailEmployeeTest extends TestCase
{
    use RefreshDatabase, EmployeeAuth, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if employees can be retrieved By ID from Employee Role.
     *
     * @return void
     */
    public function test_get_employee_detail_with_employee_role()
    {
        $token = $this->authenticateEmployee();

        $this->doRequest($token);
    }

    protected function doRequest($token): void
    {
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/employees/7');

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

    /**
     * Test if employees can be retrieved By ID from Manager Role.
     *
     * @return void
     */
    public function test_get_employee_detail_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }
}
