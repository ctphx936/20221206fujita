<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index']);
Route::post('/', [ContactController::class, 'post']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'post']);

//確認フォーム後に登録//
Route::get('/contact_re', [ContactController::class, 'contact_re']);
Route::post('/contact_re', [ContactController::class, 'create']);
Route::get('/thanks', [ContactController::class, 'thanks']);

//管理システム//
Route::get('/admin', [ContactController::class, 'admin']);
Route::post('/admin', [ContactController::class, 'admin']);


//入力ページ
//Route::get('/', 'ContactController@index')->name('contact.index');
//確認ページ
//Route::post('/', 'ContactController@confirm')->name('contact.confirm');
//送信完了ページ
//Route::post('/', 'ContactController@send')->name('contact.send');



Route::get('/verror', [ContactController::class, 'verror']);

Route::get('/find', [ContactController::class, 'find']);
Route::post('/find', [ContactController::class, 'search']);

Route::get('/add', [ContactController::class, 'add']);
Route::post('/add', [ContactController::class, 'create']);

Route::get('/edit', [ContactController::class, 'edit']);
Route::post('/edit', [ContactController::class, 'update']);

Route::get('/delete', [ContactController::class, 'delete']);
//Route::post('/delete', [ContactController::class, 'remove']);
Route::post('/remove{id}', [ContactController::class, 'remove'])->name('remove');
