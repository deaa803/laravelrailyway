<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/create', [ProductController::class, 'create']); // عرض الفورم
Route::post('/products', [ProductController::class, 'store']); // استقبال البيانات وحفظها


require __DIR__.'/auth.php';



