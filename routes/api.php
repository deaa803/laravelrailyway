<?php

use App\Http\Controllers\animalcontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\new_userController;
use App\Http\Controllers\ordercontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\vetcontroller;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::get('/product', [ProductController::class,'index']);
Route::post('/add-product', [ProductController::class,'store']);
Route::get('/animals', [AnimalController::class,'index']);
Route::get('/order', [OrderController::class,'index']);
Route::get('/vet', [VetController::class,'index']);
Route::post('/add-animals', [animalcontroller::class,'store']);
Route::get('/cart', [CartController::class,'getItems']);
Route::post('/add-cart', [CartController::class,'store']);
Route::put('/cart/{id}', [CartController::class,'updateItem']);
Route::delete('/cart/{id}', [CartController::class,'deleteItem']);
// تسجيل الدخول يلي عملتوو
Route::post('/login_new',[new_userController::class,'login']);
Route::post('/register_new',[new_userController::class,'register']);

//authentication---------------------------------------------------------------------


 Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
     return $request->user();
 });

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
 Route::middleware('auth:sanctum')->get('/user/revoke',function (Request $request){
     $user = $request->user();
     $user->tokens()->delete();
     return 'token are deleted';
 });
