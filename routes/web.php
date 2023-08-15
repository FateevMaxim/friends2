<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('admin');

Route::get('/stock', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('stock');

Route::get('/register-me', function () {
    return view('register-me');
})->middleware(['auth', 'verified'])->name('register-me');

Route::middleware('auth')->group(function () {
    Route::post('/file-import', [ProductController::class, 'fileImport'])->name('file-import');
    Route::get('/file-export', [ProductController::class, 'fileExport'])->name('file-export');
    Route::get('/archive', [DashboardController::class, 'archive'])->name('archive');
    Route::post('/china-product', [ProductController::class, 'addChina'])->name('china-product');
    Route::post('/almatyin-product', [ProductController::class, 'almatyIn'])->name('almatyin-product');
    Route::post('/almatyout-product', [ProductController::class, 'almatyOut'])->name('almatyout-product');
    Route::post('/getinfo-product', [ProductController::class, 'getInfoProduct'])->name('getinfo-product');
    Route::post('/client-product', [ProductController::class, 'addClient'])->name('client-product');
    Route::post('/accept-product', [ProductController::class, 'acceptProduct'])->name('accept-product');
    Route::post('/client-product-archive', [ProductController::class, 'archiveProduct'])->name('client-product-archive');
    Route::post('/client-product-unarchive', [ProductController::class, 'unArchiveProduct'])->name('client-product-unarchive');
    Route::post('/delete-track', [ProductController::class, 'deleteTrack'])->name('delete-track');
    Route::post('/client-delete', [ProfileController::class, 'deleteClient'])->name('client-delete');
    Route::post('/client-edit', [ProfileController::class, 'editClient'])->name('client-edit');
    Route::post('/client-access', [ProfileController::class, 'accessClient'])->name('client-access');
    Route::post('/client-block', [ProfileController::class, 'blockClient'])->name('client-block');
    Route::post('/client-search', [ProfileController::class, 'searchClient'])->name('client-search');

    Route::post('/message-delete', [ProfileController::class, 'deleteMessage'])->name('message-delete');
    Route::post('/message-add', [ProfileController::class, 'addMessage'])->name('message-add');

    Route::get('/track_report_page', [ReportController::class, 'getTrackReportPage'])->name('track_report_page');
    Route::post('/track_report', [ReportController::class, 'getTrackReport'])->name('track_report');

    Route::get('/result', [ProductController::class, 'result'])->name('result');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
