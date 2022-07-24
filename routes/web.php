<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patients\PatientController;
use App\Http\Controllers\Invoices\EncounterController;
use App\Http\Controllers\Patients\DemographicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DemographicController::class, 'index']);
Route::get('/patients/ledger/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::get('/patients/ledger/encounter/{encounter}', [EncounterController::class, 'show'])->name('encounter.show');
