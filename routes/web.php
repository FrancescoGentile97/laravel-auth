<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// auth e verified sono classi php pre impostate già da laravel
Route::middleware([`auth`, `verified`])
    // sarà il prefisso di ogni mio URL che raggrupperò nella funzione "group"
    ->prefix("admin")
    // name indica che tutte le mie rotte inizieranno con admin.
    ->name("admin.")
    ->group(function () {
        Route::get("/", [DashboardController::class, "home"])->name("dashboard");
        Route::get("users", [DashboardController::class, "home"])->name("users");
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
