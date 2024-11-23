<?php

use App\Http\Controllers\{UserController, FacebookController};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});
// Rota principal
Route::get('/', function () {
    return redirect()->route('auth.login');
});

// Rotas de autenticação
Route::prefix('auth')->group(function () {
    // Rota de login
    Route::prefix('auth')->group(function () {
        Route::get('/login', [UserController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/login', [UserController::class, 'login'])->name('auth.login.post');
    });

     // Login com o Facebook
     Route::get('/login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.login.facebook'); // Redireciona para o Facebook
     Route::get('/login/facebook/callback', [FacebookController::class, 'handleFacebookCallback'])->name('auth.login.facebook.callback'); // Recebe o callback do Facebook

        // Rota de cadastro
    Route::get('/cadastro', [UserController::class, 'showRegistrationForm'])->name('cadastro');
    Route::post('/cadastro', [UserController::class, 'register'])->name('cadastro.store');

        // Rota para esquecer a senha
        Route::get('/forgot-password', [UserController::class, 'forgot'])->name('auth.forgot');
        Route::post('/forgot-password', [UserController::class, 'forgotPost'])->name('auth.forgot.post');
    });

   // Rota de logout
Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Rota de Receita
Route::get('/receita', [ReceitaController::class, 'index'])->name('receita');
Route::get('/receitas/create', [ReceitaController::class, 'create'])->name('rcreate');
Route::post('/receitas', [ReceitaController::class, 'store'])->name('receitas.store');
Route::get('/receitas/{receita}/edit', [ReceitaController::class, 'edit'])->name('redit');
Route::put('/receitas/{receita}', [ReceitaController::class, 'update'])->name('receitas.update');
Route::delete('/receitas/{receita}', [ReceitaController::class, 'destroy'])->name('receitas.destroy');

// Rota de Despesa
Route::get('/despesa', [DespesaController::class, 'index'])->name('despesa');
Route::get('/despesas/create', [DespesaController::class, 'create'])->name('dcreate');
Route::post('/despesas', [DespesaController::class, 'store'])->name('despesas.store');
Route::get('/despesas/{despesa}/edit', [DespesaController::class, 'edit'])->name('dedit');
Route::put('/despesas/{despesa}', [DespesaController::class, 'update'])->name('despesas.update');
Route::delete('/despesas/{despesa}', [DespesaController::class, 'destroy'])->name('despesas.destroy');

Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio');

require __DIR__.'/auth.php';
