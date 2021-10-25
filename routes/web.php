<?php

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

Route::get('/prueba_xml', [App\Http\Controllers\XMLController::class, 'prueba_xml'])->name('prueba_xml');
Route::get('/xml', [App\Http\Controllers\XMLController::class, 'saveXML'])->name('xml');
Route::get('/prueba_nueva_xml', [App\Http\Controllers\XMLController::class, 'prueba_nueva_XML'])->name('prueba_nueva_xml');
Route::get('/vista_xml', [App\Http\Controllers\XMLController::class, 'GuardarXML'])->name('vista_xml');
Route::get('/pdf', [App\Http\Controllers\PDFController::class, 'createPDF'])->name('pdf');
