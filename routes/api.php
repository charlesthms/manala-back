<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ClientOptionController;
use App\Http\Controllers\Api\HorsesController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\InvoiceItemController;
use App\Http\Controllers\Api\PensionController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Debug bar

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login',  [AuthController::class, 'login']);

Route::get('/pdf/{id}', [PDFController::class, 'generatePDF']);

Route::group(['middleware' => ['auth:sanctum']], function () {

  Route::post('/logout',                         [AuthController::class, 'logout']);
  Route::post('/me',                             [AuthController::class, 'me']);
  Route::get('/clients/{client}/invoices',       [ClientController::class, 'invoices']);
  Route::get('/invoices/archives',               [InvoiceController::class, 'archives']);

  Route::apiResource('/pensions',     PensionController::class);
  Route::apiResource('/clients',      ClientController::class);
  Route::apiResource('/clientOption', ClientOptionController::class);
  Route::apiResource('/invoices',     InvoiceController::class);
  Route::apiResource('/horses',       HorsesController::class);
  Route::apiResource('/invoiceItem',  InvoiceItemController::class);

});

Route::get('emails/{id}', [App\Http\Controllers\EmailController::class, 'view'])->name('emails.view');



Route::get('/cron/send', [App\Http\Controllers\Cron\SendInvoicesController::class, 'sendInvoices']);
Route::get('/cron/gen',  [App\Http\Controllers\Cron\GenerateInvoicesController::class, 'index']);

Route::get('/email/{id}', [App\Http\Controllers\EmailController::class, 'send']);


