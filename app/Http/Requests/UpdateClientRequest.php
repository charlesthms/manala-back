<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
      'first_name'    => 'nullable|string',
      'last_name'     => 'nullable|string',
      'email'         => 'required|email',
      'phone_number'  => 'nullable|string',
      'address'       => 'nullable|string',
      'horse'         => 'nullable|string',
      'pension_id'    => 'nullable|numeric',
    ];
  }
}
