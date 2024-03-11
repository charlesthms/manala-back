<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePensionRequest extends FormRequest
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
      'name'  => ['required', 'string', Rule::unique('pensions')->ignore($this->pension->id)],
      'price' => 'required|numeric',
      'color' => 'string',
      'description' => 'string',
      'attributes' => 'string',
      'display' => 'boolean'
    ];
  }
}
