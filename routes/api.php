<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ArrivalController;
use GuzzleHttp\Promise\Create;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//

//Route::resource('students', StudentController::class);

//public routes
//Login and register for admin
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Log arrival
Route::post('/arrivals/{student_id}', [ArrivalController::class, 'register_student']);

//get student info students
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/search/{name}', [StudentController::class, 'search']);

//Route::get('/students/showlate', [StudentController::class, 'show_late']);
//Route::get('/students/islate/{name}', [StudentController::class, 'is_late']);
Route::get('/arrivals/showlate/{student_id}', [ArrivalController::class, 'show_late_arrivals']);
//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/students', [StudentController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
