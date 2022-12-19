<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentWebController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students',[StudentWebController::class, 'index']);
Route::get('/students/add',[StudentWebController::class, 'add']);
Route::post('/students',[StudentWebController::class, 'store'])->name('students.store');
Route::post('/students/{student}/edit',[StudentWebController::class, 'edit'])->name('students.edit');
Route::post('/students/{student}',[StudentWebController::class, 'destroy'])->name('students.destroy');
// Route::get('/', [HomeController::class, 'index']);