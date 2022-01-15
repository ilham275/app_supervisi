<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as HC;

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
    return view('auth.login');
});

Auth::routes([
]);

Route::get('/home', [HC::class, 'index'])->name('home');
Route::get('/kurikulum/index', [HC::class, 'kuriindex'])->name('kurikulum.index')->middleware('is_admin');
Route::get('/kepsek/index', [HC::class, 'kepsek'])->name('kepsek.index')->middleware('is_admin');
Route::get('/kepseksuper/index', [HC::class, 'kepseksuper'])->name('kepseksuper.index')->middleware('is_admin');
Route::get('/guru/index', [HC::class, 'guru'])->name('guru.index')->middleware('is_admin');
Route::get('/gurusuper/index', [HC::class, 'gurusuper'])->name('gurusuper.index')->middleware('is_admin');
Route::post('/store', [HC::class, 'create'])->name('store')->middleware('is_admin');
Route::get('/kurikulum/guru/tosupervisor/{id}', [HC::class, 'tosupervisor'])->name('kurikulum.to.supervisor');
Route::get('/kurikulum/guru/deletesupervisor/{id}', [HC::class, 'deletesupervisor'])->name('kurikulum.delete.supervisor');
Route::get('/kurikulum/create', [HC::class, 'tocreate'])->name('tocreate')->middleware('is_admin');
Route::get('/kurikulum/edit/{id}', [HC::class, 'edit'])->name('edit');
Route::PATCH('/update/{id}',[HC::class, 'update'])->name('update');
Route::get('/kurikulum/jadwal', [HC::class, 'tojadwal'])->name('tojadwal')->middleware('is_admin');
Route::post('/jadwal', [HC::class, 'jadwal'])->name('jadwal');
Route::get('/guru/create', [HC::class, 'todokumen'])->name('guru.create')->middleware('is_admin');
Route::post('/guru/store', [HC::class, 'dokumen'])->name('guru.store')->middleware('is_admin');



