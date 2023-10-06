<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Retourner toutes les factures de ce mois, avec les relations
    $invoice = Invoice::with(['client', 'items', 'client.horses'])
      ->whereIn('status', [0, 1])
      //->whereMonth('date', Carbon::now()->addMonthNoOverflow()->month) INUTILE ?
      ->get();

    return response(json_encode($invoice), 200);

  }

  public function archives() {
    $invoices = Invoice::with(['client' => function ($query) {
      $query->withTrashed(); // Include soft-deleted clients
    }, 'items', 'client.horses'])
      ->where('status', 2)
      ->get();

    return response(json_encode($invoices), 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreInvoiceRequest $request)
  {
      //
  }

  /**
   * Display the specified resource.
   */
  public function show(Invoice $invoice)
  {
    $invoice = Invoice::with(['client'=> function ($query) {
      $query->withTrashed(); // Include soft-deleted clients
    }, 'items'])
      ->where('id', $invoice->id)
      ->first();

    return response(json_encode($invoice), 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateInvoiceRequest $request, Invoice $invoice)
  {
    $data = $request->validated();
    $invoice->update($data);

    return response($invoice, 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Invoice $invoice)
  {
    $invoice->deleteInvoice();

    return response($invoice, 200);
  }
}
