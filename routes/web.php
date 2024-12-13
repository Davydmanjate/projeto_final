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
use Illuminate\Support\Facades\Route;

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

    // Login com GitHub
    Route::get('/github', [UserController::class, 'redirectToGithub'])->name('github.login');
    Route::get('/github/callback', [UserController::class, 'handleGithubCallback'])->name('github.callback');
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

require __DIR__ . '/auth.php';
