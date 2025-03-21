<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ExamineHistoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\MedicineStatusController;
use App\Http\Controllers\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Route - Redirect to Patients Index
Route::get('/', function () {
    return redirect()->route('patients.index');
})->name('home');

// Patient Routes
Route::resource('patients', PatientController::class);

// Address Routes
Route::resource('addresses', AddressController::class);

// Examine History Routes
Route::resource('examine-histories', ExamineHistoryController::class);

// Medicine Routes
Route::resource('medicines', MedicineController::class);

// Medicine Category Routes
Route::resource('medicine-categories', MedicineCategoryController::class);

// Medicine Status Routes
Route::resource('medicine-statuses', MedicineStatusController::class);

// Unit Routes
Route::resource('units', UnitController::class);
Route::resource('brands', BrandController::class);
Route::post('brands/{id}/restore', [BrandController::class, 'restore'])->name('brands.restore');
Route::get('patients/{patient}/examine-histories', [ExamineHistoryController::class, 'indexByPatient'])->name('patients.examine-histories');

