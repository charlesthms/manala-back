<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHorseRequest;
use App\Http\Requests\UpdateHorseRequest;
use App\Models\Client;
use App\Models\Horse;

class HorsesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreHorseRequest $request)
  {
    $data = $request->validated();
    $horse = Horse::create($data);

    return response($horse, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $horses = Client::findOrFail($id)->horses;

    return response($horses, 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateHorseRequest $request, Horse $horse)
  {
    $data = $request->validated();
    $horse->update($data);

    return response($horse, 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Horse $horse)
  {
    $horse->delete();

    return response(null, 204);
  }
}
