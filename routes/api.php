<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ClientOptionController;
use App\Http\Controllers\Api\HorsesController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\InvoiceItemController;
use App\Http\Controllers\Api\PensionController;
use App\Http\Controllers\Api\Statistics;
use App\Http\Controllers\PDFController;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Storage;

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

Route::get('/pdf/{invoice_id}', [PDFController::class, 'generatePDF']);

Route::group(['middleware' => ['auth:sanctum']], function () {

  Route::post('/logout',                            [AuthController::class, 'logout']);
  Route::post('/me',                                [AuthController::class, 'me']);

  Route::get('/clients/{client}/invoices',           [ClientController::class, 'invoices']);
  Route::get('/invoices/archives',                   [InvoiceController::class, 'archives']);
  Route::get('/clients/{client}/generateInvoice',    [ClientController::class, 'generateInvoice']);
  Route::get('/clients/{client}/canGenerateInvoice', [ClientController::class, 'canGenerateInvoice']);
  Route::get('/analytics/pensionRepartion',          [Statistics::class, 'pensionRepartion']);
  Route::get('/analytics/monthlyIncomes',            [Statistics::class, 'monthlyIncomes']);
  Route::get('/pensions/refresh',                    [PensionController::class, 'refreshPrices']);

  Route::apiResource('/clients',      ClientController::class);
  Route::apiResource('/clientOption', ClientOptionController::class);
  Route::apiResource('/invoices',     InvoiceController::class);
  Route::apiResource('/horses',       HorsesController::class);
  Route::apiResource('/invoiceItem',  InvoiceItemController::class);
});

Route::post('/login',  [AuthController::class, 'login']);

Route::apiResource('/pensions',     PensionController::class);

Route::get('emails/{id}', [App\Http\Controllers\EmailController::class, 'view'])->name('emails.view');

Route::get('/cron/send', [App\Http\Controllers\Cron\SendInvoicesController::class, 'sendInvoices']);
Route::get('/cron/gen',  [App\Http\Controllers\Cron\GenerateInvoicesController::class, 'index']);

Route::get('/export', [App\Http\Controllers\Api\ExportController::class, 'export']);

Route::get("/debug", function () {
  return response()->json([
    'message' => 'Up and running!'
  ]);
});
