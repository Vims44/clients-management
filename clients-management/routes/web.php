<?php

use Illuminate\Support\Facades\Route;

// Этот маршрут отдаёт Vue-приложение
Route::get('/{any}', function () {
    return view('app'); // app.blade.php — шаблон, в который монтируется Vue
})->where('any', '.*');
