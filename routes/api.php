<?php

use App\Http\Controllers\EmployeesController;
use App\Models\Employees;
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


// menampilkan semua data
Route::get("/Employees",[EmployeesController::class, "index"]);

// menambahkan data employees
Route::post("/Employees",[EmployeesController::class, "store"]);

// menampilkan secara spesifik dari id data employees
Route::get("/Employees/{id}",[EmployeesController::class, "show"]);

// melakukan perubahan atau update data employees id tertentu
Route::put("/Employees/{id}",[EmployeesController::class, "update"]);

// menghapus data employees tertentu
Route::delete("/Employees/{id}",[EmployeesController::class, "destroy"]);

// menemukan data employees menggunakan nama
Route::get("/Employees/search/{name}",[EmployeesController::class, "search"]);

Route::get("/Employees/active",[EmployeesController::class, "active"]);

Route::get("/Employees/inActive",[EmployeesController::class, "inActive"]);
