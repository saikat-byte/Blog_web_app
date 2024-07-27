<?php

use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// frontend

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/single-post', [FrontendController::class, 'single'])->name('frontend.single');


// Backend -Dashboard
Route::group(["prefix" => "dashboard"], function (){
    Route::get('/', [BackendController::class, 'index'])->name('backend.index');
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('tag', TagController::class);
});

