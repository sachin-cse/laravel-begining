<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// // new route
// Route::get('/demo/{name}/{id?}', function($name, $id=null){
//     $data = compact('name', 'id');
//     return view('demo')->with($data);
// });

// Route::post('/test', function(){
//     echo "Hare Krishna";
// });

// Route::get('/', function(){
//     return view('demo');
// });

Route::get('/register', [RegistrationController::class, 'index']);
Route::post('/register', [RegistrationController::class, 'register']);
// for captcha route
Route::get('/reload-captcha', [RegistrationController::class, 'reloadCaptcha']);
// Route::get('/', [RegistrationController::class, 'index']);
