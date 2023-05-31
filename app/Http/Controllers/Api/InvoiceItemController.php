<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceItemRequest;
use App\Http\Requests\UpdateInvoiceItemRequest;
use App\Models\InvoiceItem;

class InvoiceItemController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $invoiceItems = InvoiceItem::all();

    return response(json_encode($invoiceItems), 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreInvoiceItemRequest $request)
  {
    $invoiceItem = InvoiceItem::create($request->validated());

    return response(json_encode($invoiceItem), 200);
  }

  /**
   * Display the specified resource.
   */
  public function show(InvoiceItem $invoiceItem)
  {
    return response(json_encode($invoiceItem), 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoiceItem)
  {
    $invoiceItem->update($request->validated());

    return response(json_encode($invoiceItem), 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(InvoiceItem $invoiceItem)
  {
    $invoiceItem->delete();

    return response(json_encode($invoiceItem), 200);
  }
}
