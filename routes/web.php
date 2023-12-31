<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/

// Muestra el formulario para iniciar sesion
Route::get('/login',[LoginController::class, 'index'])->name('login');
// Realiza la consulta para iniciar sesion
Route::post('/login',[LoginController::class,'store']);

// Cierra la sesion actual
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Muestra el formulario para crear una cuenta
Route::get('/crearCuenta', [RegisterController::class,'index'])->name('register');
// Crea el registro de la cuenta
Route::post('/crearCuenta', [RegisterController::class,'store']);

// Gestiona las facturas
Route::get('/facturas',[InvoiceController::class,'index'])->name('invoice.index');
Route::get('/facturas/create',[InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/facturas',[InvoiceController::class, 'store'])->name('invoice.store');
Route::delete('/facturas/{invoice}',[InvoiceController::class, 'destroy'])->name('invoice.destroy');
Route::get('/facturas/{invoice}/edit',[InvoiceController::class,'edit'])->name('invoice.edit');
Route::put('/facturas/{invoice}', [InvoiceController::class, 'update'])->name('invoice.update');
Route::get('/facturas/pdf',[InvoiceController::class,'generarPDF'])->name('invoice.pdf');
Route::get('/facturas/xml',[InvoiceController::class,'generarXML'])->name('invoice.xml');


// Almacena el archivo 
Route::post('/files',[FilesController::class,'store'])->name('files.store');
Route::get('/files/{filename}',[InvoiceController::class, 'downloadFile'])->name('invoice.download');

// Gestiona las empresas
Route::get('/empresas',[CompanyController::class, 'index'])->name('company.index');
Route::get('/empresas/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/empresas',[CompanyController::class, 'store'])->name('company.store');
Route::delete('/empresa/{company}',[CompanyController::class, 'destroy'])->name('company.destroy');
Route::get('/empresa/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::put('/empresa/{company}',[CompanyController::class, 'update'])->name('company.update');
Route::get('/empresa/pdf',[CompanyController::class, 'generarPDF'])->name('company.pdf');
Route::get('/empresa/xml',[CompanyController::class, 'generarXML'])->name('company.xml');


// Muestra la parte publica
Route::get('/',[ClientController::class, 'index'])->name('client.index');
Route::get('/search',[ClientController::class, 'search'])->name('client.search');