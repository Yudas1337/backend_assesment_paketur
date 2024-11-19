<?php

namespace Auth;


use App\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Test that the login super_admin is success.
     *
     * @return void
     */
    public function test_login_using_super_admin(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'super_admin@gmail.com',
            'password' => 'password',
        ]);

        $responseData = $response->json('data');

        $this->assertEquals(RoleEnum::SUPER_ADMIN->value, $responseData['role']);
        $this->assertNotEmpty($responseData['token']);

        $response->assertStatus(200);
    }

    /**
     * Test that the login manager is success.
     *
     * @return void
     */
    public function test_login_using_manager(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'manager@gmail.com',
            'password' => 'password',
        ]);

        $responseData = $response->json('data');

        $this->assertEquals(RoleEnum::MANAGER->value, $responseData['role']);
        $this->assertNotEmpty($responseData['token']);

        $response->assertStatus(200);
    }

    /**
     * Test that the login employee is success.
     *
     * @return void
     */
    public function test_login_using_employee(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'employee@gmail.com',
            'password' => 'password',
        ]);

        $responseData = $response->json('data');
        $this->assertEquals(RoleEnum::EMPLOYEE->value, $responseData['role']);
        $this->assertNotEmpty($responseData['token']);

        $response->assertStatus(200);
    }
}
