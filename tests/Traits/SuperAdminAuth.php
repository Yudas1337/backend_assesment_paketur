<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\WithFaker;

trait SuperAdminAuth
{
    use WithFaker;

    protected string $token;

    /**
     * Authenticate and retrieve Bearer Token.
     */
    public function authenticateSuperAdmin(): string
    {
        if (!isset($this->token)) {
            $response = $this->postJson('/api/auth/login', [
                'email' => 'super_admin@gmail.com',
                'password' => 'password',
            ]);

            $response->assertStatus(200)
                ->assertJsonStructure(['data' => ['token']]);

            $this->token = $response->json('data.token');
        }

        return $this->token;
    }
}
