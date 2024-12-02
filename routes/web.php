<?php

use App\Http\Controllers\BridesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('admin/dashboard/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('admin/dashboard/')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/brides', [BridesController::class, 'index']);
        Route::post('/brides', [BridesController::class, 'store']);

        Route::get('/events', [EventsController::class, 'index']);
        Route::post('/events', [EventsController::class, 'store']);

        Route::get('/guests', [GuestsController::class, 'index']);
        Route::get('/guests/add', [GuestsController::class, 'add']);
        Route::post('/guests', [GuestsController::class, 'store']);
        Route::post('/guests/{id}', [GuestsController::class, 'update']);
        Route::get('/guests/data', [GuestsController::class, 'data']);

        Route::get('/gallery', [GalleryController::class, 'index']);
        Route::post('/gallery/cover', [GalleryController::class, 'coverStore']);
        Route::post('/gallery/photos', [GalleryController::class, 'photoStore']);
        Route::delete('/gallery/photos/{id}', [GalleryController::class, 'photoDelete']);
    });
});

// useless routes
// Just to demo sidebar dropdown links active states.
// Route::get('/buttons/text', function () {
//     return view('buttons-showcase.text');
// })->middleware(['auth'])->name('buttons.text');

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
