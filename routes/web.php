<?php

use App\Http\Controllers\Dashboard\DashboardStore;
use App\Http\Controllers\Dashboard\DashboardStoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPost\UserPostStoreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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
Route::get('/lapor', function () {
    return view('lapor.index');
});

Route::get('/lampiran/{filename}', function ($filename) {
    $file = Storage::disk('public')->get('lampiran/' . $filename);

    if (!$file) {
        abort(404);
    }

    return new Response($file, 200, [
        'Content-Type' => 'image/jpeg', // Sesuaikan tipe konten dengan jenis file yang diambil
    ]);
})->name('lampiran');



Route::get('/dashboard', [DashboardStoreController::class, 'showDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/{id}/edit', [DashboardStoreController::class, 'showEditForm'])->name('dashboard.edit');
Route::put('/dashboard/{id}', [DashboardStoreController::class, 'updatePost'])->name('dashboard.update');
Route::delete('/dashboard/{id}', [DashboardStoreController::class, 'deletePost'])->name('dashboard.delete');


Route::get('/lapor', [UserPostStoreController::class, 'showDataLapor'])->name('lapor.index');
Route::post('userposts', UserPostStoreController::class)->name('userposts.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
