<?php

use App\Http\Controllers\web\AdministracaoController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\MercadoLivreController;
use App\Http\Controllers\web\RelatorioController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;

###########################
# novo modelo de autenticação - como utilizar
################################
// // Nova rota autenticada simples (exemplo: página de administração)
// Route::view('admin', 'admin')
//     ->middleware(['auth'])
//     ->name('admin');

// // Exemplo: Rota com controlador (se você criar um)
// Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('users.index');

// // Agrupando múltiplas rotas autenticadas para organização
// Route::middleware(['auth'])->group(function () {
//     Route::view('settings', 'settings')->name('settings');
//     Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports');
// });
#################################

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

    ########################
    # USUARIOS
    ########################

    Route::post('/themeMode/{id}', [UserController::class, 'theme'])->name('theme');
    Route::get('/administracao/usuarios', [UserController::class, 'listaUsers'])->name('usuarios');
    Route::post('/administracao/usuarios/add', [UserController::class, 'addUsuarios'])->name('usuariosAdd');
    Route::put('/administracao/usuarios/edit/{id}', [UserController::class, 'editUsuarios'])->name('usuariosEdit');
    Route::put('/administracao/usuarios/editStatus/{id}', [UserController::class, 'editStatusUsuarios'])->name('usuariosStatus');
    Route::delete('/administracao/usuarios/destroy/{id}', [UserController::class, 'deleteUsuarios'])->name('usuariosDelete');
    # Perfis
    Route::get('/administracao/usuarios/{id}', [UserController::class, 'usuariosPerfil'])->name('usuariosPerfil');
    Route::post('/administracao/usuarios/addPerfil/{id}', [UserController::class, 'addPerfil'])->name('addPerfil');
    Route::delete('/administracao/usuarios/delPerfil/{id}', [UserController::class, 'delPerfil'])->name('delPerfil');

    ########################
    # ADMINISTRAÇÃO
    ########################

    Route::get('/dashboardAdm', [AdministracaoController::class, 'home'])->name('dashboardAdm');

    ########################
    # RELATORIOS
    ########################

    Route::get('/dashboardRelatorio', [RelatorioController::class, 'home'])->name('dashboardRel');

    ########################
    # MERCADO LIVRE
    ########################

    Route::get('/dashboardMercadoLivre', [MercadoLivreController::class, 'dashboard'])->name('dashboardML');

});

require __DIR__.'/auth.php';
