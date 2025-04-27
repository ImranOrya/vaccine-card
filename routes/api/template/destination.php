<?php

use App\Enums\PermissionEnum;
use App\Enums\SubPermissionEnum;
use App\Http\Controllers\api\template\DestinationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(["authorized:" . 'epi:api'])->group(function () {
  Route::post('/epi/destination/store', [DestinationController::class, "store"])->middleware(["epiHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configuration_destination->value . ',' . 'add']);
  Route::delete('/epi/destination/{id}', [DestinationController::class, "destroy"])->middleware(["epiHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configuration_destination->value . ',' . 'delete']);
  Route::post('/epi/destination/update', [DestinationController::class, "update"])->middleware(["epiHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configuration_destination->value . ',' . 'edit']);
});

Route::prefix('v1')->middleware(["authorized:" . 'finance:api'])->group(function () {
  Route::post('/finance/destination/store', [DestinationController::class, "store"])->middleware(["financeHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configuration_destination->value . ',' . 'add']);
  Route::delete('/finance/destination/{id}', [DestinationController::class, "destroy"])->middleware(["financeHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configuration_destination->value . ',' . 'delete']);
  Route::post('/finance/destination/update', [DestinationController::class, "update"])->middleware(["financeHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configuration_destination->value . ',' . 'edit']);
});

Route::prefix('v1')->group(function () {
  Route::get('/destinations', [DestinationController::class, "destinations"]);
  Route::get('/destination/{id}', [DestinationController::class, "destination"]);
  Route::get('/complete-destinations', [DestinationController::class, "completeDestinations"]);
  Route::get('/muqams', [DestinationController::class, "muqams"]);
  Route::get('/directorates', [DestinationController::class, "directorates"]);
});
