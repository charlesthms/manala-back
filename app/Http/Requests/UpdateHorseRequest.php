<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHorseRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'id' => 'required|exists:horses,id',
      'name' => 'required|string',
      'client_id' => 'required|uuid|exists:clients,id',
      'pension_id' => 'required|exists:pensions,id',
    ];
  }
}
