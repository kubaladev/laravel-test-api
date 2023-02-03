<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
//Route::get('/students', [StudentController::class, 'index']);
//Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/search/{name}', [StudentController::class, 'search']);
Route::get('/students/showlate', [StudentController::class, 'show_late']);
Route::get('/students/islate/{name}', [StudentController::class, 'is_late']);
Route::resource('students', StudentController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
