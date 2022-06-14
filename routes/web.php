<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;

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

Route::get('/', [NoteController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'notes'])->name('notes');
    Route::get('/fetch-all-notes', [NoteController::class, 'fetchAll']);
    Route::get('/fetch-deleted-notes', [NoteController::class, 'fetchDeleted']);
    Route::get('/fetch-archived-notes', [NoteController::class, 'fetchArchived']);
    Route::post('/add-note', [NoteController::class, 'store']);
    Route::get('/edit-note/{id}', [NoteController::class, 'edit']);
    Route::put('/update-note/{id}', [NoteController::class, 'update']);
    Route::delete('/delete-note/{id}', [NoteController::class, 'destroy']);
    Route::put('/restore-note/{id}', [NoteController::class, 'restore']); 
    Route::delete('/forse-delete-note/{id}', [NoteController::class, 'forseDestroy']);

    Route::get('/fetch-all-tags', [TagController::class, 'fetchAll']);
    Route::get('/fetch-notes-by-tag/{id}', [TagController::class, 'fetchNotesByTag']);
    Route::get('/fetch-tags-types', [TagController::class, 'fetchTagsTypes']);
    Route::post('/add-tag', [TagController::class, 'store']);
    Route::get('/edit-tag/{id}', [TagController::class, 'edit']);
    Route::put('/update-tag/{id}', [TagController::class, 'update']);
    Route::delete('/delete-tag/{id}', [TagController::class, 'destroy']);
});


require __DIR__.'/auth.php';