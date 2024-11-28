<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    // Testes de login
    public function test_successful_login()
    {
        // Crie um usuário de teste
        $user = User::factory()->create([
            'email' => 'ana@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        // Tente fazer login
        $credentials = [
            'email' => 'ana@gmail.com',
            'password' => '12345678'
        ];

        $this->assertTrue(
            auth()->attempt($credentials)
        );
    }

    public function test_failed_login_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'ana@gmail.com',
            'password' => Hash::make('correct_password')
        ]);

        $credentials = [
            'email' => 'ana@gmail.com',
            'password' => 'wrong_password'
        ];

        $this->assertFalse(
            auth()->attempt($credentials)
        );
    }
}
