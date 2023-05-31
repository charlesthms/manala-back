<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientOptionRequest;
use App\Http\Requests\UpdateClientOptionRequest;
use App\Models\ClientOption;

class ClientOptionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return ClientOption::all();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreClientOptionRequest $request)
  {
    $clientOption = ClientOption::create($request->validated());

    return response($clientOption, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(ClientOption $clientOption)
  {
    return $clientOption;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClientOptionRequest $request, ClientOption $clientOption)
  {
    $clientOption->update($request->validated());

    return response($clientOption, 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ClientOption $clientOption)
  {
    $clientOption->delete();

    return response(null, 204);
  }
}
