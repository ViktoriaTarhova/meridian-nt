<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AgentController;

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Страницы категорий
Route::prefix('properties')->name('properties.')->group(function () {
    Route::get('/apartments', [PropertyController::class, 'apartments'])->name('apartments');
    Route::get('/apartments/{id}', [PropertyController::class, 'show'])->name('show');
    Route::get('/houses', [PropertyController::class, 'houses'])->name('houses');
    Route::get('/plots', [PropertyController::class, 'plots'])->name('plots');
    Route::get('/rent', [PropertyController::class, 'rent'])->name('rent');

    Route::middleware('auth')->group(function () {
        Route::get('/create', [PropertyController::class, 'create'])->name('create');
        Route::post('/', [PropertyController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PropertyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PropertyController::class, 'update'])->name('update');
        Route::delete('/{id}', [PropertyController::class, 'destroy'])->name('destroy');
    });
});

// Услуги
Route::get('/services', [ServiceController::class, 'index'])->name('services');
// Услуги
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Управление услугами (только для админов)
Route::middleware(['auth'])->prefix('services')->name('services.')->group(function () {
    Route::get('/create', [ServiceController::class, 'create'])->name('create');
    Route::post('/', [ServiceController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
    Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
});

// Статические страницы
Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contacts');

// АВТОРИЗАЦИЯ
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ПРОФИЛЬ
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::put('/change-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('/saved', [ProfileController::class, 'saved'])->name('saved');
    Route::get('/my-properties', [ProfileController::class, 'myProperties'])->name('my-properties');

    // Аватарка
    Route::post('/avatar', [ProfileController::class, 'uploadAvatar'])->name('avatar.upload');
    Route::delete('/avatar', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
});

// Избранное
Route::middleware('auth')->post('/properties/{id}/favorite', [PropertyController::class, 'toggleFavorite'])->name('properties.favorite');

// Админ панель
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('agents', AgentController::class);
}); 
