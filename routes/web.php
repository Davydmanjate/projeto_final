<?php

use App\Http\Controllers\{
    UserController,
    FacebookController,
    ProfileController,
    ReceitaController,
    DespesaController,
    RelatorioController,
    AuditController
};
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Middleware para rotas autenticadas
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Rota principal
Route::get('/', function () {
    return redirect()->route('auth.login');
});

// Rotas de autenticação
Route::prefix('auth')->group(function () {
    // Login
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [UserController::class, 'login'])->name('auth.login.post');

    // Login com o Facebook
    Route::get('/login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.login.facebook');
    Route::get('/login/facebook/callback', [FacebookController::class, 'handleFacebookCallback'])->name('auth.login.facebook.callback');

    // Cadastro
    Route::get('/cadastro', [UserController::class, 'showRegistrationForm'])->name('cadastro');
    Route::post('/cadastro', [UserController::class, 'register'])->name('cadastro.store');

    // Esqueceu a senha
    Route::get('/forgot-password', [UserController::class, 'forgot'])->name('auth.forgot');
    Route::post('/forgot-password', [UserController::class, 'forgotPost'])->name('auth.forgot.post');
});

// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Rotas de Receita
Route::prefix('receitas')->group(function () {
    Route::get('/', [ReceitaController::class, 'index'])->name('receita');
    Route::get('/create', [ReceitaController::class, 'create'])->name('rcreate');
    Route::post('/', [ReceitaController::class, 'store'])->name('receitas.store');
    Route::get('/{receita}/edit', [ReceitaController::class, 'edit'])->name('redit');
    Route::put('/{receita}', [ReceitaController::class, 'update'])->name('receitas.update');
    Route::delete('/{receita}', [ReceitaController::class, 'destroy'])->name('receitas.destroy');
});

// Rotas de Despesa
Route::prefix('despesas')->group(function () {
    Route::get('/', [DespesaController::class, 'index'])->name('despesa');
    Route::get('/create', [DespesaController::class, 'create'])->name('dcreate');
    Route::post('/', [DespesaController::class, 'store'])->name('despesas.store');
    Route::get('/{despesa}/edit', [DespesaController::class, 'edit'])->name('dedit');
    Route::put('/{despesa}', [DespesaController::class, 'update'])->name('despesas.update');
    Route::delete('/{despesa}', [DespesaController::class, 'destroy'])->name('despesas.destroy');
});

// Relatório
Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio');

// Auditorias
Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');

// Login com GitHub
Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

// Callback do GitHub
Route::get('/auth/github/callback', function () {
    try {
        $githubUser = Socialite::driver('github')->stateless()->user();

        // Verifica se o usuário existe
        $user = User::where('email', $githubUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email,
                'phone' => $githubUser->phone,
                'password' => Hash::make(Str::random(16)),
                'github_id' => $githubUser->id,
                'avatar' => $githubUser->avatar,
            ]);
        } else {
            // Atualiza informações de usuário existente
            $user->update([
                'github_id' => $githubUser->id,
                'avatar' => $githubUser->avatar,
                'github_token' => $githubUser->token,
            ]);
        }

        // Faz login do usuário
        Auth::login($user);

        // Redireciona ao dashboard
        return redirect()->route('/dashboard')->with('success', 'Login realizado com sucesso!');
    } catch (\Exception $e) {
        return redirect('/auth/login')->withErrors('Erro ao realizar login com GitHub.');
    }
});

require __DIR__ . '/auth.php';
