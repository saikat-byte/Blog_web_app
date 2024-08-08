<?php

use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserProfileController;
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
Route::get('/all-post', [FrontendController::class, 'all_post'])->name('frontend.all_post');
Route::get('/search', [FrontendController::class, 'search'])->name('frontend.search');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('frontend.category');
Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontendController::class, 'sub_category'])->name('frontend.subcategory');
Route::get('/tag/{slug}', [FrontendController::class, 'tag'])->name('frontend.tag');
Route::get('/single-post/{slug}', [FrontendController::class, 'single'])->name('frontend.single');
Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('frontend.contactus');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');


// Backend -Dashboard
Route::group(["prefix" => "dashboard"], function (){
    Route::get('/', [BackendController::class, 'index'])->name('backend.index');
    Route::resource('category', CategoryController::class);
    Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('tag', TagController::class);
    Route::resource('post', PostController::class);
    Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
    Route::resource('comment', CommentController::class);
    Route::resource('user-profile', UserProfileController::class);
    Route::get('user-states',[ UserProfileController::class, 'getStates'])->name('states');
    Route::get('user-cities',[ UserProfileController::class, 'getCities'])->name('cities');

});

