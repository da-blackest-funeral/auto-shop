<?php

use App\Http\Controllers\Api\AttributesController;
use App\Http\Controllers\Api\AutopartController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::apiResources([
    '/autoparts' => AutopartController::class,
    '/cars' => CarController::class,
    '/categories' => CategoryController::class,
    '/attributes' => AttributesController::class,
]);
