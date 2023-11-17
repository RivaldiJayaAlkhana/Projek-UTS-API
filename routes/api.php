<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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
// Route untuk membuat endpoint employees dan menambahkan authentication sanctum 
    Route::middleware('auth:sanctum')->group(function () {

    //Route untuk menampilkan semua employees
    Route::get('employees', [EmployeesController::class, "index"]);

    //Route untuk menambahkan employees
    Route::post('employees', [EmployeesController::class, "store"]);
    
    //Route untuk mencari detail employees
    Route::get('employees/{id}', [EmployeesController::class, "show"]);
    
    //Route untuk mengedit employees
    Route::put('employees/{id}', [EmployeesController::class, "update"]);
    
    //Route untuk menghapus employees
    Route::delete('employees/{id}', [EmployeesController::class, "destroy"]);

    //Route untuk mencari sesuai nama employees
    Route::get('employees/search/{name}', [EmployeesController::class, "search"]);

    //Route untuk mencari status employees yang aktif
    Route::get('employees/status/active', [EmployeesController::class, "active"]);

    //Route untuk mencari status employees yang tidak aktif
    Route::get('employees/status/inactive', [EmployeesController::class, "inactive"]);

    //Route untuk mencari status employees di berhentikan
    Route::get('employees/status/terminated', [EmployeesController::class, "terminated"]);
});

    // Route untuk register dan login student
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
