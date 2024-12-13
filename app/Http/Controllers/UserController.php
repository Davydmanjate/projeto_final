<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
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

        return redirect()->route('auth.login')->with('success', 'Cadastro realizado com sucesso!');
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

        return redirect()->route('auth.login')->with('success', 'Logout realizado com sucesso!');
    }

    /**
     * Redireciona o usuário para a página de autenticação do GitHub.
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Trata o retorno da autenticação do GitHub.
     */
    public function handleGithubCallback()
    {
        try {
            // Obtém os dados do usuário do GitHub
            $githubUser = Socialite::driver('github')->stateless()->user();

            // Verifica se o usuário já existe no banco de dados
            $user = User::where('email', $githubUser->email)->first();

            // Se não existir, cria um novo usuário
            if (!$user) {
                $user = User::create([
                    'name' => $githubUser->name,
                    'email' => $githubUser->email,
                    'github_id' => $githubUser->id,
                    'password' => Hash::make(uniqid()), // Gera uma senha aleatória
                ]);
            }

            // Faz login do usuário
            Auth::login($user);

            // Redireciona para o dashboard
            return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');

        } catch (\Exception $e) {
            // Em caso de erro, redireciona de volta para o login
            return redirect()->route('auth.login')->with('error', 'Erro na autenticação do GitHub');
        }
    }
}
