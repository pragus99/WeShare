<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\PhotoController;
use App\Http\Controllers\Frontend\PhotoController as FrontendPhotoController;
use App\Http\Controllers\Backend\RingtoneController;
use App\Http\Controllers\Frontend\RingtoneController as FrontendRingtoneController;
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

Route::get('/', [FrontendRingtoneController::class, 'index'])->name('ringtone.index');
Route::get('/ringtone/{id}/{slug}', [FrontendRingtoneController::class, 'show'])->name('ringtone.show');
Route::post('/ringtone/download/{id}', [FrontendRingtoneController::class, 'downloadRingtone'])->name('ringtone.download');
Route::get('/category/{id}', [FrontendRingtoneController::class, 'category'])->name('ringtone.category');

Route::get('/wallpapers', [FrontendPhotoController::class, 'index']);
Route::post('/download/xlarge/{id}', [FrontendPhotoController::class, 'download1280x1024'])->name('xlarge');
Route::post('/download/large/{id}', [FrontendPhotoController::class, 'download800x600'])->name('large');
Route::post('/download/medium/{id}', [FrontendPhotoController::class, 'download316x255'])->name('medium');
Route::post('/download/small/{id}', [FrontendPhotoController::class, 'download118x95'])->name('small');


Route::group(array('middleware' => 'auth'), function () {
    Route::resource('/ringtones', RingtoneController::class);
    Route::resource('/photos', PhotoController::class);
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
