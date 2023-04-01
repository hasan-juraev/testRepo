<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
// In case Eloquent ORM, use below code:
// use App\Models\User;
use Illuminate\Support\Facades\DB;

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


Route::get('/home', function () {
    echo "This is home page";
});


Route::get('/about', function () {
    return view('about');
});

// Contact Controller
Route::get('/contact-asdf-asdfgh', [ContactController::class, 'index'])->name('contact');



// CategoryController
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

// CategoryController
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

// Edit category name
// method Edit created
// Edit method must be declared in CategoryController
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);


// Update category name
// method Update created
// Update method must be declared in CategoryController
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);


// Trash List
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

// Trash List
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);

// Permanent delete
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);


//================================================= For Brand route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

// store brand
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');

// Brand edit
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

// Update method 
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);



// Middleware
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // In case Eloquent ORM, use below code:
    // $users = User::all(); 

    // Query Builder
    $users = DB:: table('users')->get();
    return view('dashboard', compact('users'));
    
})->name('dashboard');
