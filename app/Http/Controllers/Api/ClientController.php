<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Invoice;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return Client::all();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreClientRequest $request)
  {
    $data = $request->validated();

    $horse = $data['horse'];
    $pension_id = $data['pension_id'];
    unset($data['horse']);
    unset($data['pension_id']);

    $client = Client::create($data);
    $client->horses()->create([
      'name' => $horse,
      'client_id' => $client->id,
      'pension_id' => $pension_id,
    ]);

    return response($client, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Client $client)
  {

    $client->load('horses');

    return $client;

  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClientRequest $request, Client $client)
  {
    $data = $request->validated();

    if(isset($data['horse'])) {
      $horse = $data['horse'];
      $pension_id = $data['pension_id'];
      unset($data['horse']);
      unset($data['pension_id']);
    }

    $client->update($data);

    if(isset($horse)) {
      $client->horses()->update([
        'name' => $horse,
        'client_id' => $client->id,
        'pension_id' => $pension_id,
      ]);
    }

    return response($client, 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Client $client)
  {

    $deleted = $client->delete();

    return response(json_encode("deleted : " . $deleted), 204);
  }

  public function invoices(Client $client)
  {
    return response($client->invoices, 200);
  }

  public function horses(Client $client)
  {
    return response($client->horses, 200);
  }

  public function generateInvoice(Client $client)
  {
    $horses = $client->horses;
    $count = 0;

    foreach($horses as $horse) {
      $client->generateInvoice($horse, true);
      $count++;
    }

    return response($count . " factures générées.", 201);
  }

  public function canGenerateInvoice(Client $client) {
    $invoice = $client->invoices()
      ->where('date', '>=', now()->startOfMonth())
      ->where('date', '<=', now()->endOfMonth())
      ->first();

    if(isset($invoice)) {
      return response(json_encode(false), 200);
    } else {
      return response(json_encode(true), 200);
    }
  }

}
