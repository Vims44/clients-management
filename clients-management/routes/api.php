<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Здесь вы можете зарегистрировать маршруты API для вашего приложения.
| Эти маршруты загружаются RouteServiceProvider, и все они будут
| использовать группу посредников "api".
*/

Route::get('/clients', [ClientController::class, 'index']); // Список клиентов
Route::post('/clients', [ClientController::class, 'store']); // Создание клиента
Route::put('/clients/{id}', [ClientController::class, 'update']); // Обновление клиента
Route::delete('/clients/{id}', [ClientController::class, 'destroy']); // Удаление клиента
Route::get('/clients/{id}', [ClientController::class, 'show']); // Получение одного клиента

