<?php

namespace Employee;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\EmployeeAuth;
use Tests\Traits\ManagerAuth;

class GetEmployeeTest extends TestCase
{
    use RefreshDatabase, EmployeeAuth, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if employees can be retrieved with pagination, sorting, and search filters from Employee Role.
     *
     * @return void
     */
    public function test_get_employee_pagination_with_employee_role()
    {
        $token = $this->authenticateEmployee();

        $this->doRequest($token);

    }

    protected function doRequest(string $token): void
    {
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/employees?sort=desc&perPage=10&search=');

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

    /**
     * Test if employees can be retrieved with pagination, sorting, and search filters from Manager Role.
     *
     * @return void
     */
    public function test_get_employee_pagination_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }
}