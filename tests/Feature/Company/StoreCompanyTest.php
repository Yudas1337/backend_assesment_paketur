<?php

namespace Company;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\SuperadminAuth;

class StoreCompanyTest extends TestCase
{
    use RefreshDatabase, SuperadminAuth;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test creating a company via POST request.
     */
    public function test_creates_a_company_from_super_admin(): void
    {
        $token = $this->authenticateSuperAdmin();

        $data = [
            'name' => 'Perusahaan 1',
            'email' => 'yudasmalabi@gmail.com',
            'phone_number' => '082257181297',
        ];

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/companies', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('companies', $data);
    }
}
