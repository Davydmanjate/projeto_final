<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserModelTest extends TestCase
{
    public function test_user_model_validation()
    {
        $userData = [
            'name' => 'Ana',
            'email' => 'ana@gmail.com',
            'password' => '12345678'
        ];

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];

        $validator = Validator::make($userData, $rules);

        $this->assertFalse($validator->fails());
    }

    public function test_user_password_hashing()
    {
        $user = User::factory()->create([
            'password' => 'plain_password'
        ]);

        // Verifica se a senha foi hashada
        $this->assertTrue(
            \Hash::check('plain_password', $user->password)
        );
    }
}
