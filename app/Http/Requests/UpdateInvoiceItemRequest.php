<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceItemRequest extends FormRequest
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
      'id'         => ['required', 'exists:invoice_items,id'],
      'invoice_id' => ['required', 'exists:invoices,id'],
      'name'       => ['required', 'string', 'max:255'],
      'price'      => ['required', 'numeric'],
      'quantity'   => ['required', 'numeric', 'min:1'],
    ];
  }
}
