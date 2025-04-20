
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\app\file\FileController;



Route::prefix('v1')->middleware(["multiAuthorized:" . 'epi:api,finance:api'])->group(function () {
  Route::post('checklist/file/upload', [FileController::class, 'checklistUploadFile'])->withoutMiddleware('throttle');
  Route::post('single/checklist/file/upload', [FileController::class, 'singleChecklistFileUpload'])->withoutMiddleware('throttle');
});
