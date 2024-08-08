<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('post');
});

// Route::get("/hello/{beitaId}/comments/{commentId}", function ($id, $commentId, Request $request) {
//     return dd($id, $commentId);
// });

// Route::post("/hello", function (Request $request) {
//     return dd($request->all());
// })->name("postNama");

// Route::prefix('/products')->group(function () {
//     Route::get('/index', function () {
//         return dd('index');
//     });
//     Route::get('/create', function () {
//         return dd('create');
//     });
// });

// Route::prefix('/kategori')->group(function () {
//     Route::get('/', function () {
//         return dd('index');
//     });
//     Route::get('/create', function () {
//         return dd('create');
//     });
// });

// Route::get("/sign-in", function () {
//     return dd('login');
// })->name("login");

// Route::middleware('auth')->prefix("admin")->group(function () {
//     Route::get("/home", function () {
//         return dd('home');
//     });
//     Route::resource("siswa", SiswaController::class)->only(['create', 'update', 'destroy']);
// });

// Route::resource("siswa", SiswaController::class)->only(['index', 'show']);
// Route::resource("products", SiswaController::class);

Route::resources([
    // "siswa" => SiswaController::class,
    "kategori" => CategoryController::class,
    "book" => BookController::class,
]);

Route::get("/guru", [GuruController::class, "index"])->name("indexGuru");
Route::get("/guru/create", [GuruController::class, "create"]);
Route::post("/guru/store", [GuruController::class, "store"])->name("guru.store");
Route::get("/guru/update/{id}", [GuruController::class, "update"]);

Auth::routes([
    'verify' => true,
    'register' => true,
    'reset' => false
]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
