<?php

namespace Employee;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ManagerAuth;

class DeleteEmployeeTest extends TestCase
{

    use RefreshDatabase, ManagerAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test if employees can be Soft Deleted.
     *
     * @return void
     */
    public function test_delete_employee_by_id_with_manager_role()
    {
        $token = $this->authenticateManager();

        $this->doRequest($token);
    }

    protected function doRequest($token): void
    {
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->delete('/api/employees/7');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'code',
                    'status',
                    'message',
                ]]);
    }

}
