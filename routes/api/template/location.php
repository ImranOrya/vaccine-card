
<?php

use App\Http\Controllers\api\template\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/countries', [LocationController::class, "countries"]);
    Route::get('/destination-countries', [LocationController::class, "destinactionCountries"]);
    Route::get('/provinces/{id}', [LocationController::class, "provinces"]);
    Route::get('/districts/{id}', [LocationController::class, 'districts']);
});
