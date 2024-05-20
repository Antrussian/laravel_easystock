<?php

use App\Http\Controllers\Api\CocktailController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cocktails', [CocktailController::class, 'index']);

Route::get('/cocktails/{cocktail:slug}', [CocktailController::class, 'show']);

Route::post('/contacts', [LeadController::class, 'store']);

Route::get('/cocktails/category/{cocktail:alcholic}', [CocktailController::class, 'alcholic']);
