<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePensionRequest;
use App\Http\Requests\UpdatePensionRequest;
use App\Models\Pension;
use App\Models\Invoice;

class PensionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    return Pension::all();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePensionRequest $request)
  {

    $data = $request->validated();
    $pension = Pension::create($data);

    return response($pension, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Pension $pension)
  {

    return $pension;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePensionRequest $request, Pension $pension)
  {

    $data = $request->validated();
    $pension->update($data);

    return response($pension, 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pension $pension)
  {

    $pension->delete();

    return response(null, 204);
  }


  public function refreshPrices()
  {

    // TODO: modifier toutes les factures en cours de traitement pour mettre le bon prix
    // 1. obtenir les factures en cours de traitement
    $invoices = Invoice::with(['items' => function ($query) {
      $query->where('is_option', 0);
    }])
      ->where('status', 0)
      ->get();

    $pensions = Pension::select('name', 'price')->get()->toArray();
    $updated = 0;

    foreach ($invoices as $invoice) {
      $item = $invoice->items->first();
      $new_price = null;

      foreach ($pensions as $pension) {
        if (str_contains($item->name, $pension["name"])) $new_price = $pension['price'];
      }

      if ($item->price != $new_price) {
        $item->price = $new_price;
        $item->save();
        $updated++;
      }
    }

    return response()->json([
      'message' => $updated . " invoices updated"
    ]);
  }
}
