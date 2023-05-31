<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
      'first_name'   => ['required', 'string', 'max:255'],
      'last_name'    => ['required', 'string', 'max:255'],
      'email'        => ['nullable', 'email', 'max:255'],
      'phone_number' => ['nullable', 'string', 'max:10'],
      'address'      => ['nullable', 'string', 'max:255'],
      'horse'        => ['nullable', 'string', 'max:255'],
      'pension_id'   => ['nullable', 'exists:pensions,id'],
    ];
  }
}
