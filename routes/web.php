<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentWebController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Auth\AuthController;

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

// Auth Routes
Route::get('/register', [AuthController::class, 'registerUser'])->name('register');
Route::post('/register', [AuthController::class, 'saveUser'])->name('register');
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'handle'])->name('login');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students',[StudentWebController::class, 'index'])->name('students.index');
Route::get('/students/add',[StudentWebController::class, 'add'])->name('students.add');
Route::get('/students/{student}/add-image',[StudentWebController::class, 'addImage'])->name('students.addimage');
Route::post('/students',[StudentWebController::class, 'store'])->name('students.store');
Route::post('/students/{student}/save-image/',[StudentWebController::class, 'saveImage'])->name('students.saveimage');
Route::get('/students/{student}/edit',[StudentWebController::class, 'edit'])->name('students.edit');
Route::get('/students/{student}',[StudentWebController::class, 'show'])->name('students.show');
Route::post('/students/{student}',[StudentWebController::class, 'destroy'])->name('students.destroy');
Route::patch('/students/{student}',[StudentWebController::class, 'update'])->name('students.update');
// Route::get('/students/search/',[StudentWebController::class, 'search'])->name('students.index');


// Department Routes
Route::get('/departments',[DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/add',[DepartmentController::class, 'add'])->name('departments.add');
Route::post('/departments',[DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments/{department}',[DepartmentController::class, 'show'])->name('departments.show');
Route::get('/departments/{department}/edit',[DepartmentController::class, 'edit'])->name('departments.edit');
Route::patch('/departments/{department}',[DepartmentController::class, 'update'])->name('departments.update');
Route::post('/departments/{department}',[DepartmentController::class, 'destroy'])->name('departments.destroy');







