<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePensionRequest;
use App\Http\Requests\UpdatePensionRequest;
use App\Models\Pension;

class PensionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

      return Pension::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePensionRequest $request){

      $data = $request->validated();
      $pension = Pension::create($data);

      return response($pension, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Pension $pension) {

      return $pension;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePensionRequest $request, Pension $pension) {

      $data = $request->validated();
      $pension->update($data);

      return response($pension, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pension $pension) {

      $pension->delete();

      return response(null, 204);

    }
}
