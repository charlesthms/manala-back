<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
      'status' => 'integer|between:0,3',
      'date' => 'date',
      'client_id' => 'uuid|exists:clients,id',
      'items' => 'array',
      'items.*.description' => 'string',
      'items.*.quantity' => 'integer',
      'items.*.price' => 'numeric',
    ];
  }
}
