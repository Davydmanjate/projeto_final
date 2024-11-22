<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Exibe o formulário de registro.
     */
    public function showRegistrationForm()
    {
        return view('auth.cadastro');
    }

    /**
     * Processa o registro do usuário.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|digits:9',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Faz login automaticamente após o cadastro
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Exibe o formulário de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processa o login do usuário.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Verifica as credenciais e tenta logar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');
        }

        // Limita tentativas de login e retorna erro de credenciais
        throw ValidationException::withMessages([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    /**
     * Faz logout do usuário.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }
}
